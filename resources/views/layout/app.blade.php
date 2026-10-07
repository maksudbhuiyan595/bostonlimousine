<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary SEO -->
    <title>@yield('title', 'Logan Airport Transfer | Boston Airport Car Service')</title>

    <meta name="description"
        content="@yield('meta_description', 'Reliable Logan Airport Transfer and Boston Airport Car Service. Professional chauffeurs, luxury vehicles, and 24/7 airport transportation.')">

    <meta name="keywords"
        content="@yield('meta_keywords', 'Logan Airport Transfer, Boston Airport Car Service, Airport Transportation Boston, Logan Airport Taxi, Airport Shuttle Boston')">

    <meta name="robots" content="index, follow">
    <meta name="author" content="Logan Airport Transfer">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Logan Airport Transfer | Boston Airport Car Service')">
    <meta property="og:description"
        content="@yield('meta_description', 'Reliable airport transportation services in Boston and Logan Airport.')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta property="og:site_name" content="Logan Airport Transfer">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Logan Airport Transfer | Boston Airport Car Service')">
    <meta name="twitter:description"
        content="@yield('meta_description', 'Reliable airport transportation services in Boston and Logan Airport.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/logo.png'))">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries -->
    <link href="{{ asset('frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    @yield('schema')
    @stack('styles')
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border" style="width: 3rem; height: 3rem; color: #C5A059;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    @include('layout.include.nav')

    @yield('content')

    @include('layout.include.footer')

    <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top">
        <i class="fa fa-arrow-up"></i>
    </a>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('frontend/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('frontend/js/main.js') }}"></script>

    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('notify'))
        <script>
            Swal.fire({
                icon: "{{ session('notify.type') }}", // success, error, warning
                title: "{{ session('notify.type') === 'success' ? 'Success!' : 'Error!' }}",
                text: "{{ session('notify.message') }}",
                confirmButtonColor: '#B9924B', // আপনার গোল্ড থিম কালার
                showConfirmButton: true
            });
        </script>
    @endif

    @if(session('booking_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: "{{ session('booking_success.title') }}",
                text: "{{ session('booking_success.message') }}",
                confirmButtonColor: '#B9924B',
                showConfirmButton: true
            });
        </script>
    @endif

</body>

</html>
