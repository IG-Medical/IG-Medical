<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<?php echo $__env->make('admin_panel.layouts.includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- end::Head -->

<!-- begin::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page" id="admin">
<?php echo $__env->make('admin_panel.layouts.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <?php echo $__env->make('admin_panel.layouts.includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <?php echo $__env->make('admin_panel.layouts.includes.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <!-- end:: Body -->
    <?php echo $__env->make('admin_panel.layouts.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!-- end:: Page -->


<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>

<!-- end::Scroll Top -->
<div id="loading-div" class="loading" style="display: block;">
    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    <span class="sr-only"><?php echo e(trans('admin_panel.loading')); ?>...</span>
</div>

<script>
    let ROOT_URL = '<?php echo e(url('/')); ?>';
    let BASE_URL = '<?php echo e(url_lang('/')); ?>';
    let ADMIN_PREFIX = '<?php echo e(ADMIN_PREFIX); ?>';
    let ADMIN_URL = BASE_URL + '/' + ADMIN_PREFIX;
    let TOKN = '<?php echo e(csrf_token()); ?>';
    let USER = <?php echo auth()->check() ? user() : 'null'; ?>;
    let LANGUAGES = '<?php echo json_encode(languages()) ; ?>';
    let LANG = '<?php echo getAppLocale() ; ?>';


</script>
<?php echo $__env->yieldPushContent('before_js'); ?>
<!--begin::Global Theme Bundle -->
<script src="<?php echo e(asset_admin('assets/vendors/base/vendors.bundle.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset_admin('assets/demo/default/base/scripts.bundle.js')); ?>" type="text/javascript"></script>

<!--end::Global Theme Bundle -->
<script src="<?php echo e(asset_admin('assets/app/js/custom.js')); ?>" type="text/javascript"></script>
<script>
    <?php if(session()->has('success_message') || isset($success_message)): ?>
    <?php
        $message= isset($success_message) ? $success_message : session('success_message');
    ?>
    swalSuccess('<?php echo e($message); ?>');
    <?php endif; ?>
</script>
<?php if(isset($is_module)): ?>
<?php echo $__env->yieldPushContent('js_module'); ?>
<?php else: ?>
<script src="<?php echo e(asset('js/admin/admin.js')); ?>" type="text/javascript"></script>
<?php endif; ?>
<?php echo getSetting('custom_footer'); ?>

<?php echo $__env->yieldPushContent('js'); ?>
</body>

<!-- end::Body -->
</html>
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\resources\views/admin_panel/layouts/app.blade.php ENDPATH**/ ?>