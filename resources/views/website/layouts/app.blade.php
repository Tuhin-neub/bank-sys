<!doctype html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Banking System </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('all/website/assets/images/favicons/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('all/website/assets/images/favicons/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('all/website/assets/images/favicons/favicon-16x16.png') }}" />
    <link rel="manifest" href="{{ asset('all/website/assets/images/favicons/site.webmanifest') }}" />
    <meta name="description" content="Crsine HTML Template For Car Services" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('all/website/assets/vendors/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('all/website/assets/vendors/animate/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('all/website/assets/vendors/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('all/website/assets/vendors/jarallax/jarallax.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('all/website/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('all/website/assets/vendors/nouislider/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('all/website/assets/vendors/nouislider/nouislider.pips.css') }}" />
    <link rel="stylesheet" href="{{ asset('all/website/assets/vendors/odometer/odometer.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('all/website/assets/vendors/swiper/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('all/website/assets/vendors/halpes-icons/style.css') }}">
    <link rel="stylesheet" href="{{ asset('all/website/assets/vendors/tiny-slider/tiny-slider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('all/website/assets/vendors/reey-font/stylesheet.css') }}" />
    <link rel="stylesheet" href="{{ asset('all/website/assets/vendors/owl-carousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('all/website/assets/vendors/owl-carousel/owl.theme.default.min.css') }}" />

    <!-- template styles -->
    <link rel="stylesheet" href="{{ asset('all/website/assets/css/halpes.css') }}" />
    <link rel="stylesheet" href="{{ asset('all/website/assets/css/halpes-responsive.css') }}" />


    {{-- tostr Alert --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    @yield('header-links')

</head>

<body>

    @include('website.layouts.preloader')

    <div class="page-wrapper">

        @include('website.layouts.navbar')

        <div class="stricky-header stricked-menu main-menu">
            <div class="sticky-header__content"></div>
            <!-- /.sticky-header__content -->
        </div>

        @yield('contents')


    </div>

    @include('website.layouts.mobile-navbar')

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>


    @yield('footer-links')
    <script src="{{ asset('all/website/assets/vendors/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('all/website/assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('all/website/assets/vendors/jarallax/jarallax.min.js') }}"></script>
    <script src="{{ asset('all/website/assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('all/website/assets/vendors/jquery-appear/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('all/website/assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js') }}">
    </script>
    <script src="{{ asset('all/website/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('all/website/assets/vendors/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('all/website/assets/vendors/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('all/website/assets/vendors/odometer/odometer.min.js') }}"></script>
    <script src="{{ asset('all/website/assets/vendors/swiper/swiper.min.js') }}"></script>
    <script src="{{ asset('all/website/assets/vendors/tiny-slider/tiny-slider.min.js') }}"></script>
    <script src="{{ asset('all/website/assets/vendors/wnumb/wNumb.min.js') }}"></script>
    <script src="{{ asset('all/website/assets/vendors/wow/wow.js') }}"></script>
    <script src="{{ asset('all/website/assets/vendors/isotope/isotope.js') }}"></script>
    <script src="{{ asset('all/website/assets/vendors/countdown/countdown.min.js') }}"></script>
    <script src="{{ asset('all/website/assets/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <!-- template js -->
    <script src="{{ asset('all/website/assets/js/halpes.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
    @if(Session::has('success'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.success("{{ session('success') }}");
    @endif

    @if(Session::has('error'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.warning("{{ session('warning') }}");
    @endif
    </script>

    <script>
    $('.submit-btn').click(function() {
        var name = $(this).attr('data-name');
        $(".submit-btn-" + name).attr("disabled", true);
        $('.submit-btn-' + name).html('Processing...');
        $('.submit-' + name).submit();
        return true;
    });
    </script>

    @yield('footer-links')
</body>

</html>