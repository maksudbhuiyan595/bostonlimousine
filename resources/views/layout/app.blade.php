<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Boston Nlimousine</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('/') }}frontend/lib/animate/animate.min.css" rel="stylesheet">
        <link href="{{ asset('/') }}frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('/') }}frontend/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('/') }}frontend/css/style.css" rel="stylesheet">
         @stack('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <link rel="canonical" href="{{ rtrim(request()->url(), '/') . '/' }}">
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    </head>

    <body>
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border"
                style="width: 3rem; height: 3rem; color: #C5A059;"
                role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        @include('layout.include.nav')

        @yield('content')

        @include('layout.include.footer')

        <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('/') }}frontend/lib/wow/wow.min.js"></script>
        <script src="{{ asset('/') }}frontend/lib/easing/easing.min.js"></script>
        <script src="{{ asset('/') }}frontend/lib/waypoints/waypoints.min.js"></script>
        <script src="{{ asset('/') }}frontend/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="{{ asset('/') }}frontend/js/main.js"></script>
         @stack('scripts')
    </body>

</html>
