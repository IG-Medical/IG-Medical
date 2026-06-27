<section class="subHero">
    <div class="container">
        <div class="row d-md-flex d-block sub-hero">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card" style="">
                <div class="sub-hero-img">
                    <img src="<?php echo e($category->icon_url); ?>" class="mx-auto" alt="">
                </div>
                <h6 class="pt-3"><?php echo e($category->name); ?></h6>
                <a href="<?php echo e(route('product.category',['category' => $category->slug])); ?>" class="btn btn-primary border-radius-25 fs-14"><?php echo e(trans('app.read_more')); ?></a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php $__env->startPush('css'); ?>
    <style>
        @media (max-width: 576px) {
            .subHero {
                display: none !important;
            }
        }
    </style>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\resources\views/app/home/includes/fetchers.blade.php ENDPATH**/ ?>