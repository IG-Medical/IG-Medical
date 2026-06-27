

<?php $__env->startPush('page-title'); ?>
    <?php echo e(meta('breadcrumbs-title')); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('css'); ?>
    <?php if(getAppLocale() === 'ar'): ?>
        <link href="<?php echo e(asset_admin('assets/jsTreeStyle.css')); ?>" rel="stylesheet" type="text/css" />
    <?php endif; ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <categories-index inline-template>
        <div class="m-content">
            <div class="row">
                <?php echo $__env->make($asRoute.'::admin_panel.includes.data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make($asRoute.'::admin_panel.includes.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </categories-index>
<?php $__env->stopSection(); ?>


<?php $is_module = true; ?>
<?php $__env->startPush('js_module'); ?>
    <script src="<?php echo e(asset('js/admin/category.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin_panel.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\app\Modules\Category\resources\views/admin_panel/index.blade.php ENDPATH**/ ?>