<?php $__env->startPush('page-title'); ?>
    <?php echo e(meta('breadcrumbs-title')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <pages-show inline-template>
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon"><i class="m-menu__link-icon flaticon-web"></i></span>
                                    <h3 class="m-portlet__head-text"><?php echo e(meta('breadcrumbs-title')); ?></h3>
                                </div>
                            </div>







                        </div>
                        <div class="m-portlet__body">
                            <div class="m-section">
                                <div class="m-section__content">
                                    <table-component
                                        :data="fetchData"
                                        :show-caption="false"
                                        ref="table">
                                        <table-column show="title" label="<?php echo e(trans_module_page('admin.title')); ?>"></table-column>
                                        <table-column show="created_at" label="<?php echo e(trans_module_page('admin.created_at')); ?>"></table-column>
                                        <table-column label="" :sortable="false" :filterable="false">
                                            <template slot-scope="row">
                                                <?php echo $__env->make($asRoute.'::admin_panel.includes.actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    </pages-show>
<?php $__env->stopSection(); ?>

<?php $is_module = true; ?>
<?php $__env->startPush('js_module'); ?>
<script src="<?php echo e(asset('js/admin/page.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(ADMIN_VIEWS_DIR.'.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\app\Modules\Page\resources\views//admin_panel/index.blade.php ENDPATH**/ ?>