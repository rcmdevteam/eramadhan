<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $masjid->name }} :: {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-zinc-100">
    <div class="w-full"
        style="background-image: url('{!! asset('images/cover-ori.jpg') !!}'); background-size: cover; background-position: center center">
        <div class="container ml-auto mr-auto h-[150px] md:h-[250px]">
        </div>
    </div>
    <div class="w-full pb-20">
        <div class="container ml-auto mr-auto">
            <div class="size-32 bg-zinc-500 ml-auto mr-auto -mt-20 md:-mt-20 rounded-lg mb-6 pb-10 z-40"
                style="background-image: url('{!! asset('images/avatar.jpeg') !!}'); background-size: cover; background-position: center center">
            </div>
            <h1 class="text-center text-2xl font-black mb-2">{{ $masjid->name }}</h1>
            <h2 class="text-center text-xl text-black-100">Tempahan {{ config('app.name') }} {{ $ramadhan->tahun }}H
            </h2>
            <div class="py-10">
                <div class="flex flex-col gap-4 text-center w-[450px] ml-auto mr-auto">
                    <h2 class="uppercase text-sm font-bold">Pilih Lot</h2>
                    @foreach ($lots as $lot)
                        <div class="p-4 {{ $lot->quota - $lot->transactions->where('status', 'paid')->count() == 0 ? 'bg-slate-400' : 'bg-white' }} rounded-md hover:shadow mx-4 md:mx-0 lot-ramadhan cursor-pointer"
                            data-lotid="{{ $lot->id }}" data-hari="{{ $lot->hari }}"
                            data-jumlah="{{ $lot->jumlah_lot }}" data-ramadhan="{{ $lot->ramadhan->id }}"
                            data-masjid="{{ $lot->masjid->id }}">
                            <div class="flex flex-row">
                                <div>
                                    <div class="p-2 rounded-md bg-zinc-100">
                                        <h5 class="text-xs">ramadhan</h5>
                                        <h2 class="text-2xl">{{ $lot->hari }}</h2>
                                        <p class="text-xs text-gray-500">1 Mac 2023 (Selasa)</p>
                                    </div>
                                </div>
                                <div class="text-right flex flex-col items-right w-full pt-1">
                                    <h3 class="font-bold">RM {{ $lot->jumlah_lot }} / lot</h3>
                                    <p class="text-sm text-gray-500">Jumlah Tajaan: RM {{ $lot->sasaran }}</p>
                                    <p class="text-sm text-gray-500">Lot Kosong: <span
                                            class="text-red-600 font-bold">{{ $lot->quota - $lot->transactions->where('status', 'paid')->count() }}/{{ $lot->quota }}</span>
                                    </p>
                                    <p class="text-sm text-gray-500">{{ $lot->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
        <div style="background-image: url('{!! asset('images/cover-ori.jpg') !!}'); background-size: cover; background-position: center center"
            class="rounded-t-lg">
            <div class="p-8 bg-black/50 hover:shadow">
                <div class="flex flex-row">
                    <div class="text-center">
                        <div class="p-2 rounded-md bg-white">
                            <h5 class="text-xs">ramadhan</h5>
                            <h2 class="text-2xl">
                                <div id="display_hari"></div>
                            </h2>
                        </div>
                    </div>
                    <div class="text-right flex flex-col items-right w-full pt-1">
                        <h3 class="font-bold text-white text-3xl">RM <span id="display_jumlah_lot"></span>
                        </h3>
                        <p class="text-white/80">1 Lot</p>
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
                    value="">
                <label for="email" class="flex text-left mb-2 text-sm text-gray-900">
                    Email
                </label>
                <input type="text" name="email" id="email" class="border p-1 rounded mb-4 px-1.5" required
                    value="">
                <label for="phone" class="flex text-left mb-2 text-sm text-gray-900">
                    Telefon No
                </label>
                <input type="text" name="phone" id="phone" class="border p-1 rounded mb-4 px-1.5" required
                    value="">
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
                <p class="text-sm text-gray-400">&copy; eRamadhan &middot; Bukti pembayaran akan di dihantar ke
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

                // return console.log('lotid:' + lotid + ' hari:' + hari + ' jumlah:' + jumlah + ' ramadhan:' +
                //     ramadhan +
                //     ' masjid:' + masjid);

                // Set data into the form inputs
                $("#form_container #display_hari").html(hari);
                $("#form_container #display_jumlah_lot").html(jumlah);

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
                // Handle form submission logic here

                // After submission, hide the form
                $("#form_container").removeClass("visible").addClass("invisible");
            });
        });
    </script>
</body>

</html>
