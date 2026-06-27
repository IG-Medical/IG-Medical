<?php $__env->startPush('page-title',$pageTitle); ?>


<?php $__env->startSection('content'); ?>
    <main id="main">
        <?php echo $__env->make('app.layouts.includes.breadcrumbs',['breadcrumb_image'=> $breadcrumb], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="blog-details mt-3 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mb-4 text-1A5468"><?php echo e($news->title); ?></h5>
                        <?php if(isset($news->image_url[getAppLocale()])): ?>
                        <div class="w-100">
                            <img src="<?php echo e($news->image_url[getAppLocale()]); ?>" class="img-fluid" alt="">
                        </div>
                        <?php endif; ?>
                        <div class="w-100 mt-4 mb-4 new_details">
                          <?php echo $news->content; ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php $__env->stopSection(); ?>

<?php $is_module = true; ?>
<?php $__env->startPush('js_module'); ?>
    <script src="<?php echo e(asset('js/app/news.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('app.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\app\Modules\News\resources\views//app/details.blade.php ENDPATH**/ ?>