<?php

use App\Http\Controllers;
use App\Models\Lot;
use App\Models\Masjid;
use App\Models\Ramadhan;
use App\Models\RamadhanTransaction;
use App\Rules\StartsSix;
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

Route::get('/data/lot', 'App\Http\Controllers\PublicController@getDataLots');

Route::any('/payment/toyyibpay/callback', function (Request $request) {
    \Log::info(request()->all());

    $data = request()->all();
    $masjidId = request()->order_id;

    $order_id_key = array_search('order_id', array_keys($data));
    $transactionId = null;

    if ($order_id_key !== false && isset(array_keys($data)[$order_id_key + 1])) {
        $next_key = array_keys($data)[$order_id_key + 1];
        $transactionId = $next_key;
    }

    $transaction = RamadhanTransaction::whereId($transactionId)->whereMasjidId($masjidId)->firstOrFail();

    if ($request->input('status') == '1' || $request->input('reason') == 'Approved') {

        // Update Order
        $transactionUpdate                     = RamadhanTransaction::find($transactionId);
        $transactionUpdate->status             = 'paid'; // approved invoice
        // $transactionUpdate->receipt            = 'toyyibpay.png';
        $transactionUpdate->mark_as_paid       = \Carbon\Carbon::now();
        $transactionUpdate->toyyibpay_refno    = request('refno');
        $transactionUpdate->toyyibpay_billcode = request('billcode');
        $transactionUpdate->toyyibpay_ref = request('transaction_id');
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


Route::prefix('{masjid}')->middleware(['checking'])->group(function () {



    Route::get('/', function ($masjid) {
        $masjid = Masjid::where('short_name', $masjid)->firstOrFail();

        if ($masjid->offline == 0) {
            return view('offline.index', compact('masjid'));
        }

        $ramadhan = Ramadhan::where('tahun', 1445)->where('masjid_id', $masjid->id)->firstOrFail();
        $lots = Lot::where('masjid_id', $masjid->id)->where('ramadhan_id', $ramadhan->id)->orderBy('hari', 'ASC')->get();

        return view('collections.index', compact('masjid', 'ramadhan', 'lots'));
    });

    Route::post('/payment', function ($masjid) {

        // Validate the incoming request data
        $validatedData = request()->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => ['required', 'string', new StartsSix, 'min:5'],
            // Add more validation rules as needed
        ], [
            'phone.required' => 'Nombor telefon diperlukan'
        ]);

        $masjid = Masjid::where('short_name', $masjid)->firstOrFail();

        // $name = request()->nama;
        // $email = request()->email;
        // $phone = request()->phone;
        // $jumlah = request()->jumlah;
        // $hari = request()->hari;
        // $lotid = request()->lotid;
        // $masjid = request()->masjid;
        // $ramadhan = request()->ramadhan;

        $name = $validatedData['nama'];
        $email = $validatedData['email'];
        $phone = $validatedData['phone'];
        $jumlah = request()->jumlah;
        $hari = request()->hari;
        $lotid = request()->lotid;
        $masjid = request()->masjid;
        $ramadhan = request()->ramadhan;
        $tarikh_masihi = request()->tarikh_masihi;



        // perform insert transaction
        $transaction = new RamadhanTransaction();
        $transaction->nama = $name;
        $transaction->emel = $email;
        $transaction->telefon = $phone;
        $transaction->ramadhan = $hari;
        $transaction->jumlah = $jumlah;
        $transaction->kuantiti = 1;
        // $transaction->toyyibpay_ref = $tarikh_masihi;
        $transaction->status = 'unpaid';
        $transaction->ramadhan_id = $ramadhan;
        $transaction->masjid_id = $masjid;
        $transaction->lot_id = $lotid;
        $transaction->save();

        // if (is_null($masjid->toyyibpay_secret_key) && is_null($masjid->toyyibpay_collection_id)) {
        //     return redirect()->back()->with('bill_error', true)->with('message', 'No payment gateway setup.');
        // }

        $amountToPay = collect(\Money\Money::MYR(number_format($jumlah, 2, '', '')))->toArray();

        // if ($masjid->option_toyyibpay_type == null) {
        // $toyyibPayMethod = 0;
        // } else {
        // $toyyibPayMethod = $masjid->option_toyyibpay_type;
        // }
        $description = "1 Lot, " . $transaction->ramadhan . " Ramadhan " . \App\Models\Ramadhan::whereId($transaction->ramadhan_id)->first()->tahun . ", " . $tarikh_masihi;

        // get masjid details
        $detailMasjid = Masjid::whereId($transaction->masjid_id)->first();
        $urlToyyibPay = ($detailMasjid->toyyibpay_secret_key)
            ? 'https://toyyibpay.com' // prod
            : 'https://dev.toyyibpay.com'; // test

        // Perform Toyyibpay
        $toyyibpay = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $result    = $toyyibpay->post($urlToyyibPay . '/index.php/api/createBill', [
            'form_params' => [
                // 'userSecretKey'           => $masjid->toyyibpay_secret_key,
                'userSecretKey'           => ($detailMasjid->toyyibpay_secret_key) ? $detailMasjid->toyyibpay_secret_key : env('TOY_SKEY'),
                'categoryCode'            => ($detailMasjid->toyyibpay_collection_id) ? $detailMasjid->toyyibpay_collection_id : env('TOY_CID'),
                'billName'                => $name,
                'billDescription'          => $description,
                // 'billDescription'         => 'Bayaran Lot: ' . $lotid . ' untuk Ramadhan: ' . $ramadhan,
                'billPriceSetting'        => 1,
                'billPayorInfo'           => 1, // fix toyyibpay covid
                'billAmount'              => $amountToPay['amount'],
                'billReturnUrl'           => \URL::previous(),
                'billCallbackUrl'         => config('app.url') . '/payment/toyyibpay/callback',
                'billExternalReferenceNo' => $masjid . '&' . $transaction->id, // StoreID & OrderId
                'billTo'                  => $name,
                'billEmail'               => $email,
                'billPhone'               => $phone,
                'billSplitPayment'        => 0,
                'billSplitPaymentArgs'    => '',
                'billPaymentChannel'      => config('payment.toyyibpay.payment_type'),
            ],
        ]);

        $banks = json_decode($result->getBody());

        // check last buffer
        $lot = Lot::find($transaction->lot_id);
        if (($lot->quota - $lot->transactions->where('status', 'paid')->count()) == 0) {
            return redirect()->back()->with('error', true)->with('message', 'Opps! You just passed the quota! Cuba lain slot');
        }

        foreach ($banks as $bank) {
            return redirect()->to($urlToyyibPay . '/' . $bank->BillCode);
        }
    });
});
