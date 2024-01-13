<?php

use App\Models\Lot;
use App\Models\Masjid;
use App\Models\Ramadhan;
use App\Models\RamadhanTransaction;
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

Route::get('/home', function () {
    return redirect(backpack_url('/dashboard'));
});

Route::get('/payment/toyyibpay/callback', function (Request $request) {

    $transactionReferenceNo = $request->input('order_id');

    $checkReference = explode('&', $transactionReferenceNo);

    $masjidId = $checkReference[0];
    $transactionId = $checkReference[1];

    $transaction = RamadhanTransaction::whereId($transactionId)->whereMasjidId($masjidId)->where(
        'status',
        '!=',
        2
    )->firstOrFail();

    if ($request->input('status') == '1' || $request->input('reason') == 'Approved') {

        // Update Order
        $transactionUpdate                     = RamadhanTransaction::find($transactionId);
        $transactionUpdate->status             = '2'; // approved invoice
        // $transactionUpdate->receipt            = 'toyyibpay.png';
        $transactionUpdate->mark_as_paid       = \Carbon\Carbon::now();
        $transactionUpdate->toyyibpay_refno    = request('refno');
        $transactionUpdate->toyyibpay_billcode = request('billcode');
        $transactionUpdate->save();

        $message = 'Payment was successful.';

        if ($transaction->emel) {
            // receipt from store to customer
            $data                = [];
            $data['email']       = $transaction->emel;
            $data['name']        = $transaction->nama;
            $data['order_no']    = $transaction->id;

            /*Mail::send('emails.payment_success', $data, function ($m) use ($data) {
                    $m->from($data['store_email'], $data['store_name']);
                    $m->to($data['email'],
                        $data['name'])->subject('Hola! Your payment has been success for Order #' . $data['order_no']);
                });*/

            /* Email to Masjid */
            // Mail::send('emails.remind_to_owner_payment_success', $data, function ($m) use ($data) {
            //     $m->from('hai@kedaiweb.co', 'Kedaiweb.co Team');
            //     $m->to(
            //         $data['store_email'],
            //         $data['store_name']
            //     )->subject('You got payment from Invoice #' . $data['order_no']);
            // });

            /* Send email details */
            // Mail::to($order->customer->email)->send(new EmailDetailInvoice($order));
        }

        return 'OK';
    }

    // \Log::info('just retrieve from bank');
    return 'OK';
});


Route::prefix('/p/{masjid}')->middleware(['checking'])->group(function () {
    Route::get('/', function ($masjid) {
        $masjid = Masjid::where('name', $masjid)->firstOrFail();
        $ramadhan = Ramadhan::where('tahun', 1445)->where('masjid_id', $masjid->id)->firstOrFail();
        $lots = Lot::where('masjid_id', $masjid->id)->where('ramadhan_id', $ramadhan->id)->orderBy('hari', 'ASC')->get();

        return view('collections.index', compact('masjid', 'ramadhan', 'lots'));
    });

    Route::post('/payment', function ($masjid) {
        dd($masjid, request()->all());

        $masjid = Masjid::where('name', $masjid)->first();
        $name = '';
        $email = '';
        $phone = '';

        // perform insert transaction
        $transaction = RamadhanTransaction::create(request()->except('_token'));

        if (is_null($masjid->toyyibpay_secret_key) && is_null($masjid->toyyibpay_collection_id)) {
            return redirect()->back()->with('bill_error', true)->with('message', 'No payment gateway setup.');
        }

        $amountToPay = collect(\Money\Money::MYR(number_format(request()->amount, 2, '', '')))->toArray();

        if ($masjid->option_toyyibpay_type == null) {
            $toyyibPayMethod = 0;
        } else {
            $toyyibPayMethod = $masjid->option_toyyibpay_type;
        }

        // Perform Toyyibpay
        $toyyibpay = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $result    = $toyyibpay->post('https://dev.toyyibpay.com/index.php/api/createBill', [
            'form_params' => [
                'userSecretKey'           => $masjid->toyyibpay_secret_key,
                'categoryCode'            => $masjid->toyyibpay_collection_id,
                'billName'                => 'Lot Masjid no ' . $transaction->id,
                'billDescription'         => 'Details for order no ' . $transaction->id,
                'billPriceSetting'        => 1,
                'billPayorInfo'           => 1, // fix toyyibpay covid
                'billAmount'              => $amountToPay['amount'],
                'billReturnUrl'           => \URL::previous(),
                'billCallbackUrl'         => config('app.url') . '/payment/toyyibpay/callback',
                'billExternalReferenceNo' => $masjid->id . '&' . $transaction->id, // StoreID & OrderId
                'billTo'                  => $name,
                'billEmail'               => $email,
                'billPhone'               => $phone,
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