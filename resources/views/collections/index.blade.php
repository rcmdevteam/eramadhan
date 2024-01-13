<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $masjid }} :: {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <h1 class="text-center text-2xl font-black mb-2">{{ $masjid }}</h1>
            <h2 class="text-center text-xl text-black-100">Tempahan {{ config('app.name') }} 1445H</h2>
            <div class="py-10">
                <div class="flex flex-col gap-4 text-center w-[450px] ml-auto mr-auto">
                    <h2 class="uppercase text-sm font-bold">Pilih Lot</h2>
                    @for ($i = 1; $i < 32; $i++)
                        <div class="p-4 bg-white rounded-md hover:shadow mx-4 md:mx-0">
                            <div class="flex flex-row">
                                <div>
                                    <div class="p-2 rounded-md bg-zinc-100">
                                        <h5 class="text-xs">ramadhan</h5>
                                        <h2 class="text-2xl">{{ $i }}</h2>
                                    </div>
                                </div>
                                <div class="text-right flex flex-col items-right w-full pt-1">
                                    <h3 class="font-bold">RM 100.00</h3>
                                    <p>10/10</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="text-center mt-20">
                <p class="text-sm text-gray-400">&copy; eRamadhan</p>
            </div>

            <div class="bg-white w-full md:w-[550px] ml-auto mr-auto fixed shadow-lg rounded-t-lg inset-x-0 bottom-0">
                <div
                    style="background-image: url('{!! asset('images/cover-ori.jpg') !!}'); background-size: cover; background-position: center center">
                    <div class="p-8 bg-black/50 rounded-t-lg hover:shadow">
                        <div class="flex flex-row">
                            <div class="text-center">
                                <div class="p-2 rounded-md bg-white">
                                    <h5 class="text-xs">ramadhan</h5>
                                    <h2 class="text-2xl">10</h2>
                                </div>
                            </div>
                            <div class="text-right flex flex-col items-right w-full pt-1">
                                <h3 class="font-bold text-white text-3xl">RM 100.00</h3>
                                <p class="text-white/80">1 Lot</p>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ url($masjid . '/payment') }}" method="POST">
                    <div class="flex flex-col items-left justify-center p-8">
                        <label for="name" class="flex text-left mb-2 text-sm text-gray-900">
                            Nama
                        </label>
                        <input type="text" name="nama" class="border p-1 rounded mb-4 px-1.5" required
                            value="">
                        <label for="email" class="flex text-left mb-2 text-sm text-gray-900">
                            Email
                        </label>
                        <input type="text" name="email" class="border p-1 rounded mb-4 px-1.5" required
                            value="">
                        <label for="phone" class="flex text-left mb-2 text-sm text-gray-900">
                            Telefon No
                        </label>
                        <input type="text" name="phone" class="border p-1 rounded mb-4 px-1.5" required
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
        </div>
    </div>
</body>

</html>
