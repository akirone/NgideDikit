<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>NgideDikit - Generator Ide Random</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="user/img/favicon.png" rel="icon">
    <link href="user/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="user/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="user/vendor/aos/aos.css" rel="stylesheet">
    <link href="user/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="user/css/main.css" rel="stylesheet">
    @yield('css')
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center">
                <img src="{{ asset('user/img/lampu_ajaib.png') }}" alt="Idea Bulb" class="my-icon"
                    style="width: 40px; height: 40px;">
                <h1 class="sitename">NgideDikit</h1>
            </a>
            @include('layouts.user.navbar')

        </div>
    </header>

    @yield('content')

    @hasSection('hide.footer')
        @if (!View::hasSection('hide.footer'))
            @include('layouts.user.footer')
        @endif
    @else
        @include('layouts.user.footer')
    @endif

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('user/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('user/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('user/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('user/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const navmenu = document.getElementById('navmenu');
        const toggle = document.querySelector('.mobile-nav-toggle');

        toggle.addEventListener('click', () => {
            navmenu.classList.toggle('active');
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @yield('scripts')

</body>

</html>
