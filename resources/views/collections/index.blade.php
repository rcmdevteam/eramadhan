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

<body class="bg-zinc-100">
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
            <h2 class="text-center text-xl text-slate-600">Tempahan {{ config('app.name') }} {{ $ramadhan->tahun }}H
            </h2>
            <div class="py-10">
                <div class="flex flex-col gap-4 text-center w-[450px] ml-auto mr-auto">

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

                            $transaction = App\Models\RamadhanTransaction::whereId($transactionId)
                                ->whereStatus('paid')
                                ->firstOrFail();
                        @endphp
                        @if ($transaction)
                            <div class="mx-4">
                                <div
                                    class="px-4 p-2 bg-green-100 text-green-700 rounded border-1 border-green-700 mb-4 shadow">
                                    <h4>Alhamdulillah ! Bayaran telah diterima.</h4>
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
                                            <td class="">{{ $transaction->nama }}</td>
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
                        @endif
                    @else
                        <h2 class="uppercase text-sm font-bold">Pilih Lot</h2>
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

                            <div class="p-4 {{ $lot->quota - $lot->transactions->where('status', 'paid')->count() == 0 ? 'bg-slate-400 cursor-not-allowed' : 'bg-white cursor-pointer lot-ramadhan' }} rounded-md hover:shadow-md mx-4 md:mx-0 {{ $lot->hari == '30' ? 'invisible' : 'visible' }}"
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
                        <div class="p-2 rounded-md bg-white w-[100px] h-[96px]">
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
                <button type="submit"
                    class="bg-black text-white/90 font-bold uppercase p-4 text-sm rounded-md mt-2 mb-2">bayar
                    lot</button>
                <p class="text-sm text-gray-400">&copy; eRamadhan &middot; Bukti pembayaran akan di hantar ke
                    akaun
                    emel anda.</p>
                @csrf
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
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
        });
    </script>
</body>

</html>
