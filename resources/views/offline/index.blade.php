<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tutup Sementara :: {{ $masjid->name }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    style="background-image: url('{!! $masjid->cover ? Storage::url($masjid->cover) : asset('/images/cover-ori.jpg') !!}'); background-size: cover; background-position: center center">
    <div class="container text-center h-screen items-center mt-10 px-4">
        <h1 class="text-xl mb-10">{{ $masjid->name }}</h1>
        <h1>Sistem dalam penyelenggaraan.</h1>
        <p class="text-zinc-400">Sila berhubung dengan pentadbir {{ $masjid->name }} di <a
                href="https://wa.me/{{ $masjid->phone }}">Whatsapp</a></p>
        <p class="text-sm mt-20 text-zinc-400">&copy; eRamadhan</p>
    </div>
</body>

</html>
