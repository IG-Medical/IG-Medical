<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ app_name() }} | @stack('page-title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
{{--    <link href="{{ asset_app('img/favicon.png') }}" rel="icon">--}}
{{--    <link href="{{ asset_app('img/apple-touch-icon.png') }}" rel="apple-touch-icon">--}}
    <link href="{{ $data['favicon'] }}" rel="shortcut icon" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset_app('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset_app('vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset_app('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset_app('vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset_app('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset_app('vendor/line-awesome/css/line-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset_app('vendor/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset_app('vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset_app('vendor/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset_app('vendor/aos/aos.css') }}" rel="stylesheet">

    <link href="{{ asset_app('vendor/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset_app('css/style.css') }}" rel="stylesheet">
    @stack('css')
    <style>
        .color-red{
            color: red!important;
        }
        [v-cloak] > * {
            display: none;
        }
        .font-size-product {
            font-size: 20px!important;
        }
        .nav-menu a:not(.dropdown-item) {
            margin-left: 0!important;
        }
    </style>
</head>
