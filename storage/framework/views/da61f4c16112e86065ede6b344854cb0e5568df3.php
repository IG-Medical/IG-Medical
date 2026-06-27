<!-- ======= companies Section ======= -->
<section id="companies" class="companies" style="padding: 0 !important;">
    <div class="">

        <?php $j= 0; ?>

        <div class="">
            <div id="companiesCarousel" class="carousel carousel-fade" data-ride="carousel" >
                <div class="carousel-inner" style="max-width: unset !important;">
                    <?php $__currentLoopData = $sliders_2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="carousel-item <?php echo e($j ==0 ? 'active' : ''); ?>">
                            <div class="testimonials-image-container">
                                <img src="<?php echo e($testimonial->show_background_url); ?>" class="testimonials-image animate__animated animate__fadeIn" style="width: 100%; height: 100%" alt="">
                            </div>
                        </div>
                        <?php $j++; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Control prev -->
                <a class="carousel-control-prev" href="#companiesCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only"><?php echo e(trans('app.previous')); ?></span>
                </a>
                <!-- Control next -->
                <a class="carousel-control-next" href="#companiesCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only"><?php echo e(trans('app.next')); ?></span>
                </a>
            </div>
        </div>
    </div>
</section><!-- End companies Section -->
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\resources\views/app/home/includes/testimonials.blade.php ENDPATH**/ ?>