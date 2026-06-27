<div class="m-tabs-content__item m-tabs-content__item--active" id="general">
    <h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20"><?php echo e(trans_module_product('admin.general')); ?></h4>
    <?php echo html_entity_decode(build_fields('name',trans_module_product('admin.product_name'))); ?>

    <?php echo html_entity_decode(build_fields('short_description',trans_module_product('admin.short_description'),null,'textarea')); ?>

    <div class="row">
        <?php $__currentLoopData = languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 pb-4">
                <div class="form-group m-form__group">
                    <label for="<?php echo e('description_'.$key); ?>"><?php echo e(trans_module_product('admin.description')); ?></label>
                    <tinymce id="<?php echo e('description_'.$key); ?>" v-model="description.<?php echo e($key); ?>" :other_options="options"></tinymce>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row">
        <div class="col-md-6 pb-4">
            <div class="form-group m-form__group">
                <label><?php echo e(trans_module_product('admin.categories')); ?></label>
                <v-jstree :data="categories" collapse show-checkbox @item-click="nodeClick"></v-jstree>
                <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.category">{{ form.validation.category[0] }}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 pb-4">
            <label class="m-checkbox">
                <input type="checkbox" v-model="is_active"> <?php echo e(trans_module_product('admin.is_enable')); ?>

                <span></span>
            </label>
            <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.is_active">{{ form.validation.is_active[0] }}</span>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\app\Modules\Product\resources\views/admin_panel/products/create-includes/general.blade.php ENDPATH**/ ?>