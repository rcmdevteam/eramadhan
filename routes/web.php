<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('public');
});

Route::get('/payment/toyyibpay/callback', function (Request $request) {
    $orderReferenceNo = $request->input('order_id');

    $checkReference = explode('&', $orderReferenceNo);

    $storeId = $checkReference[0];
    $orderId = $checkReference[1];

    $order = Order::with(['customer'])->whereId($orderId)->whereStoreId($storeId)->where(
        'status',
        '!=',
        2
    )->firstOrFail();

    if ($request->input('status') == '1' || $request->input('reason') == 'Approved') {

        // Update Order
        $orderUpdateToyyib                     = Order::find($orderId);
        $orderUpdateToyyib->status             = '2'; // approved invoice
        $orderUpdateToyyib->receipt            = 'toyyibpay.png';
        $orderUpdateToyyib->mark_as_paid       = \Carbon\Carbon::now();
        $orderUpdateToyyib->toyyibpay_refno    = request('refno');
        $orderUpdateToyyib->toyyibpay_billcode = request('billcode');
        $orderUpdateToyyib->save();

        // \Log::info($orderUpdateToyyib->save());

        User::where('id', $order->kedaiweb->user->id)->update(['prepaid_credit' => \DB::raw('prepaid_credit - ' . $order->tax_total)]);

        $message = 'Payment was successful.';

        if ($order->customer->email) {
            // receipt from store to customer
            $data                = [];
            $data['email']       = $order->customer->email;
            $data['name']        = $order->customer->name;
            $data['store_email'] = $order->kedaiweb->email;
            $data['store_name']  = $order->kedaiweb->name;
            $data['order_no']    = $order->no;

            /*Mail::send('emails.payment_success', $data, function ($m) use ($data) {
                    $m->from($data['store_email'], $data['store_name']);
                    $m->to($data['email'],
                        $data['name'])->subject('Hola! Your payment has been success for Order #' . $data['order_no']);
                });*/

            // remind to owner
            Mail::send('emails.remind_to_owner_payment_success', $data, function ($m) use ($data) {
                $m->from('hai@kedaiweb.co', 'Kedaiweb.co Team');
                $m->to(
                    $data['store_email'],
                    $data['store_name']
                )->subject('You got payment from Invoice #' . $data['order_no']);
            });

            /* Send email details */
            Mail::to($order->customer->email)->send(new EmailDetailInvoice($order));
        }

        \Log::info('toyyibpay paid');
        \Log::info($request->input());

        return 'OK';
    }

    \Log::info('just retrieve from bank');
    return 'OK';
});


Route::prefix('/{masjid}')->middleware(['checking'])->group(function () {
    Route::get('/', function ($masjid) {
        return view('collections.index', compact('masjid'));
    });

    Route::post('/payment', function ($masjid) {
        dd($masjid, request()->all());

        $order = Order::where('oid', $oid)->first();

        if (is_null($order->kedaiweb->toyyibpay_secret_key) && is_null($order->kedaiweb->toyyibpay_collection_id)) {
            return redirect()->back()->with('bill_error', true)->with('message', 'No payment gateway setup.');
        }

        if ($order->preorder == 'yes' && $order->status == 1) {
            $payment    = ' for First Payment';
            $totalToPay = $order->first_payment;
        }
        if ($order->preorder == 'yes' && $order->status == 4) {
            $payment    = ' for Second Payment';
            $totalToPay = $order->second_payment;
        }
        if ($order->preorder == 'no' && $order->status == 1) {
            $payment    = '';
            $totalToPay = $order->grand_total;
        }

        $amountToPay = collect(\Money\Money::MYR(number_format($totalToPay, 2, '', '')))->toArray();

        // return intval($amountToPay['amount']);
        // die();
        if ($order->kedaiweb->option_toyyibpay_type == null) {
            $toyyibPayMethod = 0;
        } else {
            $toyyibPayMethod = $order->kedaiweb->option_toyyibpay_type;
        }

        // Perform Toyyibpay
        $toyyibpay = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $result    = $toyyibpay->post('https://toyyibpay.com/index.php/api/createBill', [
            'form_params' => [
                'userSecretKey'           => $order->kedaiweb->toyyibpay_secret_key,
                'categoryCode'            => $order->kedaiweb->toyyibpay_collection_id,
                'billName'                => 'Kedaiweb order no ' . $order->no,
                'billDescription'         => 'Details for order no ' . $order->no,
                'billPriceSetting'        => 1,
                'billPayorInfo'           => 1, // fix toyyibpay covid
                'billAmount'              => $amountToPay['amount'],
                'billReturnUrl'           => \URL::previous(),
                'billCallbackUrl'         => config('app.url') . '/payment/toyyibpay/callback',
                'billExternalReferenceNo' => $order->kedaiweb->id . '&' . $order->id, // StoreID & OrderId
                'billTo'                  => $order->customer->name,
                'billEmail'               => trim($order->customer->email),
                'billPhone'               => trim($order->customer->phone),
                'billSplitPayment'        => 0,
                'billSplitPaymentArgs'    => '',
                'billPaymentChannel'      => $toyyibPayMethod,
            ],
        ]);

        $banks = json_decode($result->getBody());

        foreach ($banks as $bank) {
            return redirect()->to('https://toyyibpay.com/' . $bank->BillCode);
        }
    });
});
