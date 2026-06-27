<head>
    <meta charset="utf-8" />
    <title>{{ app_name() }} | @stack('page-title')</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ $data['favicon'] }}" />
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->

    <!--begin::Global Theme Styles -->
    @if(getAppLocale() === 'ar')
        <link href="{{ asset_admin('assets/vendors/base/vendors.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset_admin('assets/demo/default/base/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{ asset_admin('assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset_admin('assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @endif
    <!--end::Global Theme Styles -->
    <link href="{{ asset_admin('assets/custom.css')}} " rel="stylesheet" type="text/css" />

    @stack('css')
    {!!  getSetting('custom_header')   !!}
</head>
