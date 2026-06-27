<script>
    let ROOT_URL = '<?php echo e(url('/')); ?>';
    let BASE_URL = '<?php echo e(url_lang('/')); ?>';
    let TOKN = '<?php echo e(csrf_token()); ?>';
    let USER = <?php echo auth()->check() ? user() : 'null'; ?>;
    let LANGUAGES = '<?php echo json_encode(languages()) ; ?>';
    let LANG = '<?php echo getAppLocale() ; ?>';
    let APP_NAME = '<?php echo app_name() ; ?>';
    var DIR = "<?php echo getAppLocale() == 'ar' ? 'rtl' : 'ltr' ; ?>";
</script>

<?php echo $__env->yieldPushContent('before_js'); ?>


<script src="<?php echo e(asset_app('/vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset_app('/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset_app('/vendor/jquery.easing/jquery.easing.min.js')); ?>"></script>
<script src="<?php echo e(asset_app('/vendor/php-email-form/validate.js')); ?>"></script>
<script src="<?php echo e(asset_app('/vendor/isotope-layout/isotope.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset_app('/vendor/venobox/venobox.min.js')); ?>"></script>
<script src="<?php echo e(asset_app('/vendor/owl.carousel/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset_app('/vendor/slick/slick.min.js')); ?>"></script>
<script src="<?php echo e(asset_app('/vendor/aos/aos.js')); ?>"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" defer></script>

<script src="<?php echo e(asset_app('js/main.js')); ?>"></script>
<script>
    $('a.dropdown-toggle').on('click', function (){
        if(window.innerWidth > 992){
            window.location = $(this).attr('href');
        }

    });
</script>

<?php if(isset($is_module)): ?>
    <?php echo $__env->yieldPushContent('js_module'); ?>
<?php else: ?>
    <script src="<?php echo e(asset('js/app/app.js')); ?>" type="text/javascript"></script>
<?php endif; ?>
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\resources\views/app/layouts/includes/js.blade.php ENDPATH**/ ?>