<!DOCTYPE html>
<html dir="<?php echo e(getAppLocale() == 'ar' ? 'rtl' : 'ltr'); ?>">
<?php echo $__env->make('app.layouts.includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body>
<?php echo $__env->make('app.layouts.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div id="app" v-cloak>
    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->yieldPushContent('content_more'); ?>
    <?php echo $__env->make('app.layouts.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="modal fade video-modal" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>



<?php echo $__env->make('app.layouts.includes.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('app.layouts.includes.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldPushContent('js'); ?>
</body>
</html>
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\resources\views/app/layouts/app.blade.php ENDPATH**/ ?>