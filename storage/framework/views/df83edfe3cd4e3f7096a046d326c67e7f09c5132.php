<div class="m-tabs-content__item" id="basic_configuration">
    <h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20"><?php echo e(trans_module_product('admin.basic_configuration')); ?></h4>

    <div class="m-form__group form-group row">
        <label class="col-md-10 col-form-label"></label>
        <?php $__currentLoopData = languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 pb-4">
                <div class="form-group m-form__group">
                    <label for="<?php echo e('basic_configuration'.$key); ?>"><?php echo e(trans_module_product('admin.basic_configuration')); ?></label>
                    <tinymce id="<?php echo e('basic_configuration'.$key); ?>" v-model="basic_configuration.<?php echo e($key); ?>" :other_options="options"></tinymce>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\app\Modules\Product\resources\views/admin_panel/products/create-includes/basic-configuration.blade.php ENDPATH**/ ?>