<!DOCTYPE html>
<html lang="{{ getAppLocale() }}">
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>@lang('admin.app_title') | @stack('page-title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

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
    <link href="{{ asset_admin('assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!--RTL version:<link href="../../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
    <link href="{{ asset_admin('assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!--RTL version:<link href="../../../assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

    <!--end::Global Theme Styles -->
    <link rel="shortcut icon" href="{{ $data['favicon'] }}" />
    <style>
        .error-block{
            color: #be3d52;
        }
    </style>
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<div id="auth">
@yield('content')
</div>
<script>
    let BASE_URL = '<?php echo e(url_lang('/')); ?>';
    let ADMIN_PREFIX = '<?php echo e(ADMIN_PREFIX); ?>';
    let ADMIN_URL = BASE_URL + '/' + ADMIN_PREFIX;
    let LANG = '<?php echo getAppLocale() ; ?>';
</script>

<!--begin::Global Theme Bundle -->
<script src="{{ asset_admin('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset_admin('assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Scripts -->
<script src="{{ asset_admin('assets/app/js/custom.js') }}" type="text/javascript"></script>
{{--<script src="{{ asset_admin('assets/snippets/custom/pages/user/login.js') }}" type="text/javascript"></script>--}}
<script src="{{ asset('/js/admin/auth.js')  }}" type="text/javascript"></script>
<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
