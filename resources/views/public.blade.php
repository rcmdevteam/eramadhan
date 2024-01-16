<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Selamat Datang ke eRmadhan</title>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>

<body
    style="background-image: url({{ asset('/images/cover-ori.jpg') }}); background-position: center center; background-size: cover;">
    <div>
        <div class="flex flex-col justify-start items-center h-screen w-[400px] ml-auto mr-auto text-center pt-10">
            <div>
                <h1 class="text-3xl font-bold text-purple-600 mb-4">
                    eRamadhan
                </h1>
            </div>
            <div>
                <p class="text-gray-500">Sistem kutipan lot Iftar/Bubur Lambuk/Moreh pada bulan puasa, mudah dan
                    sistematik.
                    Hubungi kami <a href="https://wa.me/60139080721" class="text-gray-900 underline">untuk demo.</a></p>
                <p class="mt-4"><a href="{{ backpack_url('/login') }}" class="underline">Login Pentadbir</a></p>
                <p class="text-sm mt-20 text-slate-400">&copy; eRamadhan</p>
            </div>
        </div>
    </div>
</body>

</html>
