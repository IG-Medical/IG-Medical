<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
@include('admin_panel.layouts.includes.head')

<!-- end::Head -->

<!-- begin::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page" id="admin">
@include('admin_panel.layouts.includes.header')
    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        @include('admin_panel.layouts.includes.sidebar')
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            @include('admin_panel.layouts.includes.breadcrumbs')
            @yield('content')
        </div>
    </div>
    <!-- end:: Body -->
    @include('admin_panel.layouts.includes.footer')
</div>
<!-- end:: Page -->


<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>

<!-- end::Scroll Top -->
<div id="loading-div" class="loading" style="display: block;">
    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    <span class="sr-only">{{ trans('admin_panel.loading') }}...</span>
</div>

<script>
    let ROOT_URL = '<?php echo e(url('/')); ?>';
    let BASE_URL = '<?php echo e(url_lang('/')); ?>';
    let ADMIN_PREFIX = '<?php echo e(ADMIN_PREFIX); ?>';
    let ADMIN_URL = BASE_URL + '/' + ADMIN_PREFIX;
    let TOKN = '{{ csrf_token() }}';
    let USER = {!! auth()->check() ? user() : 'null' !!};
    let LANGUAGES = '<?php echo json_encode(languages()) ; ?>';
    let LANG = '<?php echo getAppLocale() ; ?>';


</script>
@stack('before_js')
<!--begin::Global Theme Bundle -->
<script src="{{ asset_admin('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset_admin('assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->
<script src="{{ asset_admin('assets/app/js/custom.js') }}" type="text/javascript"></script>
<script>
    @if (session()->has('success_message') || isset($success_message))
    @php
        $message= isset($success_message) ? $success_message : session('success_message');
    @endphp
    swalSuccess('{{$message}}');
    @endif
</script>
@isset($is_module)
@stack('js_module')
@else
<script src="{{ asset('js/admin/admin.js') }}" type="text/javascript"></script>
@endif
{!!  getSetting('custom_footer')   !!}
@stack('js')
</body>

<!-- end::Body -->
</html>
