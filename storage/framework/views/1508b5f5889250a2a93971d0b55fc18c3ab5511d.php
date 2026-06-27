

<?php $__env->startPush('page-title',$pageTitle); ?>

<?php $__env->startSection('content'); ?>
    <main id="main">
        <?php echo $__env->make('app.layouts.includes.breadcrumbs',['breadcrumb_image'=> $breadcrumb], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="mt-3 pb-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php if(isset($certification['title'][getAppLocale()])): ?>
                        <h5 class="mb-4 text-1A5468"><?php echo $certification['title'][getAppLocale()]; ?></h5>
                        <?php endif; ?>
                        <div class="w-100 mb-4">
                            <?php if(isset($certification['content'][getAppLocale()])): ?>
                            <p><?php echo $certification['content'][getAppLocale()]; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="certification-slider pt-5 pb-5 mt-3 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="certification-owl-carousel owl-carousel">
                            <?php if(isset($certification['images'])&&count($certification['images'])>0): ?>
                                <?php $__currentLoopData = $certification['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item">
                                        <?php if(isset($image['image_url'][getAppLocale()])): ?>
                                            <div class="certification-img">
                                                <img src="<?php echo e($image['image_url'][getAppLocale()]); ?>" class="img-fluid"  alt="">
                                            </div>
                                        <?php endif; ?>
                                        <?php if(isset($image['name'][getAppLocale()])): ?>
                                            <h5 class="text-1A5468 pt-3 pb-3 certification-name text-center">
                                                <?php echo $image['name'][getAppLocale()]; ?>

                                            </h5>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
    $(".certification-owl-carousel").owlCarousel({
        autoplay: true,
        dots: false,
        loop: true,
        autoplayTimeout:1000,
        autoplayHoverPause: true,
        items: 4,
        // rtl: true,
        margin:10,
        responsive: {
            0: {
                items: 2,
                loop: true,
                nav:true,
                margin: 5,
            },
            767: {
                items: 1,
                loop: true,
                nav:true,
                margin: 5,
            },
            768: {
                items: 4,
                loop: true,
                nav:true,
                dots: false,
                margin: 10,
            }
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('app.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\resources\views/app/certifications/index.blade.php ENDPATH**/ ?>