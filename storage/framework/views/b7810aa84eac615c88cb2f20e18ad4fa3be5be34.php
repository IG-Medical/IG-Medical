<?php if(meta('breadcrumbs-title') || meta('breadcrumbs')): ?>
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <?php if(meta('breadcrumbs-title')): ?>
            <h3 class="m-subheader__title"><?php echo e(meta('breadcrumbs-title')); ?></h3>
            <?php endif; ?>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="<?php echo e(route_admin('dashboard.index')); ?>" class="m-nav__link m-nav__link--icon"><i class="m-nav__link-icon la la-home"></i></a>
                </li>
                <?php if(meta('breadcrumbs')): ?>
                    <?php $__currentLoopData = meta('breadcrumbs'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route_name => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="<?php echo e($route_name ? $route_name : '#'); ?>" class="m-nav__link">
                                <span class="m-nav__link-text"><?php echo e($title); ?></span>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>
        </div>
        <?php echo $__env->yieldPushContent('breadcrumbs-right'); ?>
    </div>
</div>
<!-- END: Subheader -->
<?php endif; ?>
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\resources\views/admin_panel/layouts/includes/breadcrumbs.blade.php ENDPATH**/ ?>