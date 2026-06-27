<?php $__env->startPush('page-title',$pageTitle); ?>

<?php $__env->startSection('content'); ?>
    <main id="main">
        <?php echo $__env->make('app.layouts.includes.breadcrumbs',[
                    'breadcrumb_image' => isset($category) ? $category->breadcrumb_image_url : null,
                     'video' => [
                         'url' => isset($category) ? $category->breadcrumb_video_url : null,
                         'type' => isset($category) ? $category->breadcrumb_video_type : null,
                     ]
                  ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="pt-5 pb-5">
            <div class="container">
                <div class="section-title">
                    <p class="text-left"><?php echo e($category->name); ?></p>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <p><?php echo $category->description; ?></p>
                    </div>
                    <div class="col-md-4">
                        <img src="<?php echo e($category->image_url); ?>" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>

        <?php $__currentLoopData = $category->children1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <section id="gallery" class="lastNews gallery <?php echo e($index%2!==0 ? 'bg-none' : ''); ?>">
                <div class="container">
                    <div class="section-title">
                        <p><?php echo e($cate->name); ?></p>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $cate->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                                <div class="member" style="min-height: unset">
                                    <div class="member-img" style="padding: unset">
                                        <img src="<?php echo e($prod->main_image_url); ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="member-info">
                                        <h4 class="font-size-product"><?php echo e($prod->name); ?></h4>
                                    </div>
                                    <div class="gallery-details text-white text-center">
                                        <div class="my-auto">
                                            <a href="<?php echo e(route('product.details',['slug' => $prod->slug])); ?>">
                                            <h3 class="fs-16 pb-3"><?php echo e($prod->name); ?></h3>
                                            <p class="fs-14">
                                                <?php echo $prod->short_description; ?>

                                            </p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </main>
<?php $__env->stopSection(); ?>


<?php $is_module = true; ?>
<?php $__env->startPush('js_module'); ?>
    <script src="<?php echo e(asset('js/app/product.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('app.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\app\Modules\Product\resources\views//app/products/operating-room.blade.php ENDPATH**/ ?>