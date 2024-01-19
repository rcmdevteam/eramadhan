<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $masjid->name }} :: {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-zinc-100 overflow-x-hidden">
    <div class="w-full"
        style="background-image: url('{!! Storage::url($masjid->cover) !!}'); background-size: cover; background-position: center center">
        <div class="container ml-auto mr-auto h-[150px] md:h-[250px]">
        </div>
    </div>
    <div class="w-full pb-20">
        <div class="container ml-auto mr-auto">
            <div class="size-32 bg-zinc-500 ml-auto mr-auto -mt-20 md:-mt-20 rounded-lg mb-6 pb-10 z-40 border border-white border-4 shadow"
                style="background-image: url('{!! Storage::url($masjid->photo) !!}'); background-size: cover; background-position: center center">
            </div>
            <h1 class="text-center text-2xl font-black mb-2">{{ $masjid->name }}</h1>
            <h2 class="text-center text-xl text-slate-600">Tempahan Lot {{ config('app.name') }} {{ $ramadhan->tahun }}H
            </h2>
            <div class="py-10">

                <div
                    class="flex flex-col gap-4 text-center w-[450px] md:w-[450px] sm:w-[100%] ml-auto mr-auto px-2 md:px-2 sm:px-4">

                    @if (!request('transaction_id'))
                        <div class="mb-10">
                            <form action="#" class="flex flex-col">
                                <label for="telefon" class="inline text-slate-600">Semak Tempahan:</label>
                                <input type="number" name="telefon" placeholder="60123456789"
                                    class="p-1 rounded px-2 w-[200px] mr-auto ml-auto text-center mt-2 border"
                                    value="{{ request('telefon') }}">
                                @csrf
                            </form>
                            @if (request('telefon') && request('_token'))
                                @php
                                    $details = App\Models\Transaksi::where('telefon', request('telefon'))
                                        ->whereMasjidId($masjid->id)
                                        ->whereStatus('paid')
                                        ->get();
                                @endphp
                                @if ($details->count() == 0)
                                    <div
                                        class="mt-4 p-2 px-4 bg-slate-200 rounded shadow border border-slate-300 relative">
                                        <a href="{{ url('/' . $masjid->short_name) }}"
                                            class="bg-white absolute right-0 size-4 rounded-full w-[24px] h-[24px] text-center text-sm -mt-4 -mr-2 border">X</a>
                                        <p class="text-slate-500"><i>Tiada rekod.</i></p>
                                    </div>
                                @else
                                    <div
                                        class="p-2 px-4 mt-4 bg-green-300 text-green-800 text-left rounded relative shadow border-green-500 border">
                                        @if (request('telefon') && request('_token'))
                                            <a href="{{ url('/' . $masjid->short_name) }}"
                                                class="bg-white absolute right-0 size-4 rounded w-[24px] h-[24px] text-center text-sm -mt-4 -mr-2 border">X</a>
                                        @endif
                                        @foreach ($details as $detail)
                                            <div class="flex flex-row">
                                                <div class="flex-1">
                                                    {{ Str::limit($detail->nama, 14) }}
                                                </div>
                                                <div class="flex-1 text-right">
                                                    {{ $detail->hari }} Ramadhan &middot;
                                                    RM {{ $detail->jumlah }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-2 rounded border border-red-700 text-left px-4 mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (request('billcode') && request('transaction_id') && request('status_id') == 1)

                        @php
                            $data = request()->all();

                            $order_id_key = array_search('order_id', array_keys($data));

                            if ($order_id_key !== false && isset(array_keys($data)[$order_id_key + 1])) {
                                $next_key = array_keys($data)[$order_id_key + 1];
                                $transactionId = $next_key;
                            }

                            if (
                                App\Models\RamadhanTransaction::whereId($transactionId)
                                    ->whereStatus('unpaid')
                                    ->exists()
                            ) {
                                $updatePayment = App\Models\RamadhanTransaction::whereId($transactionId)->update([
                                    'status' => 'paid',
                                    'toyyibpay_billcode' => request()->billcode,
                                    'toyyibpay_refno' => request()->transaction_id,
                                    'mark_as_paid' => \Carbon\Carbon::now(),
                                ]);
                            }

                            $transaction = App\Models\RamadhanTransaction::whereId($transactionId)
                                ->whereStatus('paid')
                                ->firstOrFail();

                        @endphp
                        @if ($transaction)
                            <div class="mx-4">
                                <div
                                    class="px-4 p-2 bg-green-100 text-green-700 rounded border-1 border-green-700 mb-4 shadow">
                                    <h4>Alhamdulillah! Bayaran telah diterima.</h4>
                                </div>
                                <div class="bg-yellow-100 p-4 rounded shadow">
                                    <table class="text-left text-slate-700">
                                        <tr>
                                            <td>Nama</td>
                                            <td class="px-4">:</td>
                                            <td class="">{{ $transaction->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td class="px-4">:</td>
                                            <td class="">
                                                1 Lot, {{ $transaction->ramadhan }} Ramadhan
                                                {{ \App\Models\Ramadhan::whereId($transaction->ramadhan_id)->first()->tahun }}
                                                {{-- $tarikh_masihi --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>BillCode</td>
                                            <td class="px-4">:</td>
                                            <td class="">{{ request()->billcode }}</td>
                                        </tr>
                                        <tr>
                                            <td>Rujukan</td>
                                            <td class="px-4">:</td>
                                            <td class="">{{ request()->transaction_id }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah</td>
                                            <td class="px-4">:</td>
                                            <td class="">{{ $transaction->jumlah }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <a href="{{ url('/' . $masjid->short_name) }}" class="mt-4 text-slate-400">&larr; Kembali
                                ke laman
                                utama</a>

                            <a href="https://wa.me/{{ $masjid->phone }}"
                                class="text-center mt-4 flex flex-row justify-center items-start hover:underline"
                                target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" class="bi bi-whatsapp mr-2 pt-1" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                </svg>
                                <p>WhatsApp Pentadbir</p>
                            </a>
                        @endif
                    @else
                        <h2 class="uppercase text-sm font-bold">Pilih Lot</h2>

                        @php
                            function displayPartialString($inputString)
                            {
                                $length = strlen($inputString);

                                // Display the first two characters
                                echo substr($inputString, 0, 2);

                                // Display asterisks for the remaining characters
                                for ($i = 2; $i < $length; $i++) {
                                    echo '*';
                                }

                                echo PHP_EOL; // Add a new line for better formatting
                            }
                        @endphp

                        @foreach ($lots as $lot)
                            @php
                                $date = json_decode(App\Models\Calendar::where('year', \Carbon\Carbon::now()->year)->first()->data)->prayerTime;

                                foreach ($date as $item) {
                                    if (isset($item->hijri) && $item->hijri === '1445-09-' . ($lot->hari < 10 ? '0' . $lot->hari : $lot->hari)) {
                                        $dateApi = $item->date;
                                        switch ($item->day) {
                                            case 'Monday':
                                                $day = 'Isnin';
                                                break;
                                            case 'Tuesday':
                                                $day = 'Selasa';
                                                break;
                                            case 'Wednesday':
                                                $day = 'Rabu';
                                                break;
                                            case 'Thursday':
                                                $day = 'Khamis';
                                                break;
                                            case 'Friday':
                                                $day = 'Jumaat';
                                                break;
                                            case 'Saturday':
                                                $day = 'Sabtu';
                                                break;
                                            case 'Sunday':
                                                $day = 'Ahad';
                                                break;
                                        }
                                        $dateDay = $day;
                                        break; // Assuming there's only one match, you can remove break if there could be multiple matches
                                    }
                                }
                            @endphp

                            <div
                                class="{{ $lot->hari == '30' ? 'invisible' : 'visible' }} hover:shadow-md rounded-tl-md rounded-tr-md rounded-br-md rounded-bl-md">
                                <div class="p-4 {{ $lot->quota - $lot->transactions->where('status', 'paid')->count() == 0 ? 'bg-slate-400 cursor-not-allowed' : 'bg-white cursor-pointer lot-ramadhan' }} rounded-tl-md rounded-tr-md"
                                    data-lotid="{{ $lot->id }}" data-hari="{{ $lot->hari }}"
                                    data-jumlah="{{ $lot->jumlah_lot }}" data-ramadhan="{{ $lot->ramadhan->id }}"
                                    data-masjid="{{ $lot->masjid->id }}"
                                    data-tarikh="{{ $dateApi }} ({{ $dateDay }})"
                                    data-description="{{ $lot->description }}">
                                    <div class="flex flex-row">
                                        <div>
                                            <div
                                                class="p-2 rounded-md {{ $lot->quota - $lot->transactions->where('status', 'paid')->count() == 0 ? 'bg-slate-400' : 'bg-zinc-100' }} w-[100px] h-[96px]">
                                                <h5 class="text-xs upp">Ramadhan</h5>
                                                <h2 class="text-2xl font-bold">{{ $lot->hari }}</h2>
                                                <p class="text-xs text-gray-500">
                                                    @if ($lot->hari != 30)
                                                        {{ $dateApi }} <br>
                                                        ({{ $dateDay }})
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="text-right flex flex-col items-right w-full pt-1">
                                            <h3 class="font-bold">RM {{ $lot->jumlah_lot }} / lot</h3>
                                            <p class="text-sm text-gray-500">Jumlah Tajaan: RM {{ $lot->sasaran }}</p>
                                            <p class="text-sm text-gray-500">Lot Kosong: <span
                                                    class="{{ $lot->quota - $lot->transactions->where('status', 'paid')->count() == 0 ? '' : 'text-red-600 font-bold' }}">{{ $lot->quota - $lot->transactions->where('status', 'paid')->count() }}/{{ $lot->quota }}</span>
                                            </p>
                                            <p class="text-sm text-gray-500">{{ $lot->description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="bg-white px-4 mx-0 pb-2 rounded-bl-md rounded-br-md text-sm text-slate-400 border-t border-t-slate-100 pt-2">
                                    <div class="flex flex-row">
                                        <div class="flex-1 text-left">
                                            Senarai Tempahan
                                        </div>
                                        <div class="flex-1 text-right">
                                            <button class="lot-senarai"
                                                data-lotid="{{ $lot->id }}">Papar</button>
                                        </div>
                                    </div>
                                    <div class="text-left mt-2" id="senarai{{ $lot->id }}"
                                        style="display:none">
                                        <ul>
                                            @foreach ($lot->transactions()->where('status', 'paid')->get() as $item)
                                                <li class="text-slate-600">
                                                    <div class="flex flex-row">
                                                        <div class="flex-1">{{ displayPartialString($item->nama) }}
                                                        </div>
                                                        <div class="flex-1 text-right">
                                                            {{ $item->created_at->format('d-M-Y') }}</div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>
            </div>

            <div class="text-center mt-20">
                <p class="text-sm text-gray-400">&copy; eRamadhan</p>
            </div>
        </div>
    </div>

    <div class="bg-black/80 w-full h-screen fixed top-0 backdrop-blur-sm invisible" id="form_backdrop">
    </div>
    <div class="bg-white w-full md:w-[550px] ml-auto mr-auto fixed shadow-lg rounded-t-lg inset-x-0 bottom-0 invisible"
        id="form_container">
        <div id="close_form" class="absolute bg-white px-2 right-0 rounded-bl-md cursor-pointer">
            X
        </div>
        <div style="background-image: url('{!! Storage::url($masjid->cover) !!}'); background-size: cover; background-position: center center"
            class="rounded-t-lg">
            <div class="p-8 bg-black/50 hover:shadow">
                <div class="flex flex-row">
                    <div class="text-center">
                        <div class="p-2 rounded-md bg-white/80 w-[100px] h-[96px]">
                            <h5 class="text-xs">Ramadhan</h5>
                            <h2>
                                <div id="display_hari" class="font-bold text-2xl"></div>
                                <div id="display_date" class="text-xs text-gray-500"></div>
                            </h2>
                        </div>
                    </div>
                    <div class="text-right flex flex-col items-right w-full pt-1">
                        <h3 class="font-bold text-white text-3xl">RM <span id="display_jumlah_lot"></span>
                        </h3>
                        <p class="text-white/80">1 Lot</p>
                        <p class="text-white/80" id="display_description"></p>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ url($masjid->short_name . '/payment') }}" method="POST" id="form_bayaran">
            <div class="flex flex-col items-left justify-center p-8">
                <label for="name" class="flex text-left mb-2 text-sm text-gray-900">
                    Nama
                </label>
                <input type="text" name="nama" id="nama" class="border p-1 rounded mb-4 px-1.5" required
                    value="" placeholder="Nama">
                <label for="email" class="flex text-left mb-2 text-sm text-gray-900">
                    Email
                </label>
                <input type="text" name="email" id="email" class="border p-1 rounded mb-4 px-1.5" required
                    value="" placeholder="Emel">
                <label for="phone" class="flex text-left mb-2 text-sm text-gray-900">
                    Telefon No
                </label>
                <input type="text" name="phone" id="phone" class="border p-1 rounded mb-4 px-1.5" required
                    value="60" placeholder="Telefon, contoh 60">
                <input type="hidden" name="jumlah" id="jumlah" class="border p-1 rounded mb-4 px-1.5" required
                    value="">
                <input type="hidden" name="hari" id="hari" class="border p-1 rounded mb-4 px-1.5" required
                    value="">
                <input type="hidden" name="ramadhan" id="ramadhan" class="border p-1 rounded mb-4 px-1.5" required
                    value="">
                <input type="hidden" name="lotid" id="lotid" class="border p-1 rounded mb-4 px-1.5" required
                    value="">
                <input type="hidden" name="masjid" id="masjid" class="border p-1 rounded mb-4 px-1.5" required
                    value="">
                <input type="hidden" name="tarikh_masihi" id="tarikh_masihi" class="border p-1 rounded mb-4 px-1.5"
                    required value="">
                <button type="submit"
                    class="bg-black text-white/90 font-bold uppercase p-4 text-sm rounded-md mt-2 mb-2">bayar
                    lot</button>
                <img src="{{ asset('/fpx.png') }}" alt="FPX" class="my-4">
                <p class="text-sm
                    text-gray-400 text-center">&copy; eRamadhan &middot; Bukti
                    pembayaran akan di
                    hantar ke
                    akaun
                    emel anda.</p>
                @csrf
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $(".lot-ramadhan").on("click", function() {
                // Get data from the clicked div
                var lotid = $(this).data("lotid");
                var hari = $(this).data("hari");
                var jumlah = $(this).data("jumlah");
                var ramadhan = $(this).data("ramadhan");
                var masjid = $(this).data("masjid");
                var csrfToken = $('meta[name="_token"]').attr('content');
                var tarikh = $(this).data("tarikh");
                var description = $(this).data("description");

                // Set data into the form inputs
                $("#form_container #display_hari").html(hari);
                $("#form_container #display_date").html(tarikh);
                $("#form_container #display_jumlah_lot").html(jumlah);
                $("#form_container #display_description").html(description);

                $("#form_container #lotid").val(lotid);
                $("#form_container #hari").val(hari);
                $("#form_container #tarikh_masihi").val(tarikh);
                $("#form_container #jumlah").val(jumlah);
                $("#form_container #masjid").val(masjid);
                $("#form_container #ramadhan").val(ramadhan);
                $('#form_container').find('input[name="_token"]').val(csrfToken);

                // Toggle classes to show the form
                $('#form_backdrop').removeClass("invisible").addClass("visible");
                $("#form_container").removeClass("invisible").addClass("visible");
            });

            $("#close_form").on("click", function() {
                // Hide the form and clear input fields
                $('#form_container').removeClass("visible").addClass("invisible");
                $('#form_backdrop').removeClass("visible").addClass("invisible");

                $('#form_container').find('input[type="text"]').val('');
                $('#form_container').find('input[type="hidden"]').val('');
                $('#form_container').find('input[type="email"]').val('');
                $('#form_container').find('input[type="hidden"]').val('');

                $('#form_container').find('form')[0].reset();
            });

            $("#submitBtn").on("click", function() {
                $("#form_container").removeClass("visible").addClass("invisible");
            });

            $(".lot-senarai").on("click", function() {
                var lotid = $(this).data("lotid");
                $("#senarai" + lotid).toggle("slow");
            });
        });
    </script>
</body>

</html>
