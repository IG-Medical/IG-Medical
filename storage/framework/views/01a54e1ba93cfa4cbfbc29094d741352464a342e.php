<head>
    <meta charset="utf-8" />
    <title><?php echo e(app_name()); ?> | <?php echo $__env->yieldPushContent('page-title'); ?></title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="shortcut icon" href="<?php echo e($data['favicon']); ?>" />
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
    <?php if(getAppLocale() === 'ar'): ?>
        <link href="<?php echo e(asset_admin('assets/vendors/base/vendors.bundle.rtl.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset_admin('assets/demo/default/base/style.bundle.rtl.css')); ?>" rel="stylesheet" type="text/css" />
    <?php else: ?>
        <link href="<?php echo e(asset_admin('assets/vendors/base/vendors.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset_admin('assets/demo/default/base/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <?php endif; ?>
    <!--end::Global Theme Styles -->
    <link href="<?php echo e(asset_admin('assets/custom.css')); ?> " rel="stylesheet" type="text/css" />

    <?php echo $__env->yieldPushContent('css'); ?>
    <?php echo getSetting('custom_header'); ?>

</head>
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\resources\views/admin_panel/layouts/includes/head.blade.php ENDPATH**/ ?>