<section class="lastNews gallery">
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="member aos-init aos-animate" data-aos="fade-up">
                    <?php if(isset($new->image_url[getAppLocale()])): ?>
                    <div class="member-img p-0 max-h-245">
                        <a href="<?php echo e(route('news.index')); ?>/<?php echo e($new->slug); ?>">
                            <img src="<?php echo e($new->image_url[getAppLocale()]); ?>" class="img-fluid max-h-unset" alt="">
                        </a>
                    </div>
                    <?php endif; ?>

                    <div class="member-info border-0">
                        <a href="<?php echo e(route('news.index')); ?>/<?php echo e($new->slug); ?>">
                        <h4 class="font-size-20 line-1-ellipsis"><?php echo e($new->title); ?></h4>
                        </a>
                        <p class="text-muted"><?php echo e($new->date); ?></p>
                        <span class="details line-4-ellipsis"><?php echo $new->short_content; ?></span>
                        <p class="d-flex justify-content-between mb-0 pt-3">
                            <a class="text-1492E6" href="<?php echo e(route('news.index')); ?>/<?php echo e($new->slug); ?>"><?php echo e(trans('app.read_more')); ?></a>
                            <a class="text-1492E6"  href="<?php echo e(route('news.index')); ?>/<?php echo e($new->slug); ?>"><i class="ri-arrow-right-line"></i></a>
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\resources\views/app/home/includes/news.blade.php ENDPATH**/ ?>