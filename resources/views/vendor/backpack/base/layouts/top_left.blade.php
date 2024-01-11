<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" dir="{{ config('backpack.base.html_direction') }}">

<head>
    @include(backpack_view('inc.head'))
    <style>
        body {
            background-image: url('/images/bg-11.jpg');
            background-position: top right;
            background-attachment: fixed;
            background-repeat: no-repeat;
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700; 
        }

        .sidebar a.nav-link {
            color: #000 !important;
        }

        .sidebar a>i {
            color: #000 !important;
        }
    </style>
</head>

<body class="{{ config('backpack.base.body_class') }}">

    @include(backpack_view('inc.main_header'))

    <div class="app-body">

        @include(backpack_view('inc.sidebar'))

        <main class="main pt-2">

            @yield('before_breadcrumbs_widgets')

            @includeWhen(isset($breadcrumbs), backpack_view('inc.breadcrumbs'))

            @yield('after_breadcrumbs_widgets')

            @yield('header')

            <div class="container-fluid animated fadeIn">

                @yield('before_content_widgets')

                @yield('content')

                @yield('after_content_widgets')

            </div>

        </main>

    </div><!-- ./app-body -->

    <footer class="{{ config('backpack.base.footer_class') }}">
        @include(backpack_view('inc.footer'))
    </footer>

    @yield('before_scripts')
    @stack('before_scripts')

    @include(backpack_view('inc.scripts'))

    @yield('after_scripts')
    @stack('after_scripts')
</body>

</html>
