

<?php $__env->startPush('page-title'); ?>
    <?php echo e(meta('breadcrumbs-title')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <attributes-show inline-template>
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon"><i class="flaticon-users"></i></span>
                                    <h3 class="m-portlet__head-text"><?php echo e(meta('breadcrumbs-title')); ?></h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                        <?php echo $__env->make($moduleNamespace.'::admin_panel.partials.buttons.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="m-section">
                                <div class="m-section__content">
                                    <table-component :data="fetchData" :show-caption="false" ref="table">
                                        <table-column  show="name" label="<?php echo e(trans_module_product('admin.attribute_name')); ?>"></table-column>
                                        <table-column  show="attribute_set_name" label="<?php echo e(trans_module_product('admin.attribute_set_name')); ?>"></table-column>
                                        <table-column show="created_at" label="<?php echo e(trans_module_product('admin.created_at')); ?>"></table-column>
                                        <table-column label="<?php echo e(trans_module_product('admin.action')); ?>" :sortable="false" :filterable="false">
                                            <template slot-scope="row">
                                                <?php echo $__env->make($moduleNamespace.'::admin_panel.products.includes.actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </template>
                                        </table-column>
                                    </table-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </attributes-show>
<?php $__env->stopSection(); ?>


<?php $is_module = true; ?>
<?php $__env->startPush('js_module'); ?>
    <script src="<?php echo e(asset('js/admin/product.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin_panel.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\app\Modules\Product\resources\views/admin_panel/attributes/index.blade.php ENDPATH**/ ?>