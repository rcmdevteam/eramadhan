<?php

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

Route::any('/payment/toyyibpay/callback', function (Request $request) {
    \Log::info(request()->all());
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
        $transactionUpdate->status             = 'paid'; // approved invoice
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


Route::prefix('{masjid}')->middleware(['checking'])->group(function () {
    Route::get('/', function ($masjid) {
        $masjid = Masjid::where('short_name', $masjid)->firstOrFail();
        $ramadhan = Ramadhan::where('tahun', 1445)->where('masjid_id', $masjid->id)->firstOrFail();
        $lots = Lot::where('masjid_id', $masjid->id)->where('ramadhan_id', $ramadhan->id)->orderBy('hari', 'ASC')->get();

        return view('collections.index', compact('masjid', 'ramadhan', 'lots'));
    });

    Route::post('/payment', function ($masjid) {

        // Validate the incoming request data
        $validatedData = request()->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => ['required', 'string', new StartsSix, 'min:10'],
            // Add more validation rules as needed
        ]);

        $masjid = Masjid::where('short_name', $masjid)->firstOrFail();
        $masjidname = $masjid->name;

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
        $jumlah = $validatedData['jumlah'];
        $hari = $validatedData['hari'];
        $lotid = $validatedData['lotid'];
        $masjid = $validatedData['masjid'];
        $ramadhan = $validatedData['ramadhan'];



        // perform insert transaction
        $transaction = new RamadhanTransaction();
        $transaction->nama = $name;
        $transaction->emel = $email;
        $transaction->telefon = $phone;
        $transaction->ramadhan = $hari;
        $transaction->jumlah = $jumlah;
        $transaction->kuantiti = 1;
        // $transaction->toyyibpay_ref = '';
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

        // Perform Toyyibpay
        $toyyibpay = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $result    = $toyyibpay->post('https://dev.toyyibpay.com/index.php/api/createBill', [
            'form_params' => [
                // 'userSecretKey'           => $masjid->toyyibpay_secret_key,
                'userSecretKey'           => env('TOY_SKEY'),
                'categoryCode'            => env('TOY_CID'),
                'billName'                => $name,
                'billDescription'         => 'Bayaran Lot: ' . $lotid . ' untuk Ramadhan: ' . $ramadhan,
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

        foreach ($banks as $bank) {
            return redirect()->to('https://dev.toyyibpay.com/' . $bank->BillCode);
        }
    });
});
