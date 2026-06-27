<?php
    $sliderVideo = getSetting('slider_video');
?>

<?php if($sliderVideo): ?>
    
    <section id="hero" class="d-flex flex-column align-items-center">
        <div class="slider-video-container">
            <video autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: inherit;" id="sliderVideo">
                <source src="<?php echo e($sliderVideo); ?>" type="video/mp4">
                <source src="<?php echo e($sliderVideo); ?>" type="video/webm">
                <source src="<?php echo e($sliderVideo); ?>" type="video/ogg">
            </video>
        </div>
    </section>
<?php else: ?>
    
    <section id="hero" class="d-flex flex-column align-items-center">
        <div id="heroCarousel" class="container carousel carousel-fade" data-ride="carousel">
            <div class="carousel-inner">

                <?php $i= 0; ?>
                <?php $__currentLoopData = $sliders_1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="carousel-item <?php echo e($i === 0 ? 'active' :''); ?>">
                    <div data-type="image" data-url="<?php echo e($slider->show_background_url); ?>" class="d-none backgrounds"></div>
                    <div class="carousel-container">
                        <h1 class="animate__animated animate__fadeInDown" style="color: #fff;"><?php echo e($slider->caption_1); ?></h1>
                        <h1 class="animate__animated animate__fadeInUp" style="color: #fff;"><?php echo e($slider->caption_2); ?></h1>
                        <div class="hero-links animate__animated animate__fadeInUp">
                            <?php if($slider->call_to_action_text_1): ?>
                                <a href="<?php echo e($slider->call_to_action_url_1); ?>" class="btn btn-warning border-radius-25 mr-md-4 mr-0 mt-4"><?php echo e($slider->call_to_action_text_1); ?></a>
                            <?php endif; ?>
                            <?php if($slider->call_to_action_text_2): ?>
                                <a href="<?php echo e($slider->call_to_action_url_2); ?>" class="btn btn-light border-radius-25 mr-md-4 mr-0 mt-4"><?php echo e($slider->call_to_action_text_2); ?></a>
                            <?php endif; ?>
                            <?php if($slider->call_to_action_url_3): ?>
                                <a href="javascript:;" class="btn btn-warning border-radius-25 mr-4 mt-4 video-btn" data-toggle="modal" data-src="<?php echo e($slider->call_to_action_url_3); ?>" data-target="#videoModal"><i class="fa fa-play"></i><?php echo e(trans('app.watch_video')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                    <?php $i++; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Control prev -->
            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
                <span class="sr-only"><?php echo e(trans('app.previous')); ?></span>
            </a>
            <!-- Control next -->
            <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
                <span class="sr-only"><?php echo e(trans('app.next')); ?></span>
            </a>

        </div>
    </section>
<?php endif; ?>
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\resources\views/app/home/includes/sliders.blade.php ENDPATH**/ ?>