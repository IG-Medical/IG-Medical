<?php $__env->startPush('page-title'); ?>
    <?php echo e(meta('breadcrumbs-title')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <contact-us-admin-show :id="'<?php echo e(request('id')); ?>'" inline-template>
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
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <ul class="nav nav-tabs nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#m_tabs_1_1"><?php echo e(trans_module_contact_us('admin.open')); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#m_tabs_1_2"><?php echo e(trans_module_contact_us('admin.archived')); ?></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="m_tabs_1_1" role="tabpanel">
                                    <div class="m-section">
                                        <div class="m-section__content">
                                            <table-component
                                                :data="fetchData"
                                                :show-caption="false"
                                                ref="table">
                                                <table-column show="id" label="<?php echo e(trans_module_contact_us('admin.id')); ?>"></table-column>
                                                <table-column show="company_name" label="<?php echo e(trans_module_contact_us('admin.company_name')); ?>"></table-column>
                                                <table-column show="country" label="<?php echo e(trans_module_contact_us('admin.country')); ?>"></table-column>
                                                <table-column show="email" label="<?php echo e(trans_module_contact_us('admin.email')); ?>"></table-column>
                                                <table-column show="full_name" label="<?php echo e(trans_module_contact_us('admin.company_name')); ?>"></table-column>
                                                <table-column show="phone" label="<?php echo e(trans_module_contact_us('admin.phone')); ?>"></table-column>
                                                <table-column show="product.name" label="<?php echo e(trans_module_contact_us('admin.favorite_product')); ?>"></table-column>
                                                <table-column show="created_at" label="<?php echo e(trans_module_contact_us('admin.created_at')); ?>"></table-column>
                                                <table-column show="message" label="<?php echo e(trans_module_contact_us('admin.message')); ?>"></table-column>
                                                <table-column label="<?php echo e(trans_module_contact_us('admin.action')); ?>" :sortable="false" :filterable="false">
                                                    <template slot-scope="row">
                                                        <button @click="archive(row.id, row.full_name)"
                                                                title="Archive"
                                                                class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
                                                            <i class="la la-archive"></i>
                                                        </button>
                                                    </template>
                                                </table-column>
                                            </table-component>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="m_tabs_1_2" role="tabpanel">
                                    <div class="m-section">
                                        <div class="m-section__content">
                                            <table-component
                                                :data="fetchArchivedData"
                                                :show-caption="false"
                                                ref="table1">
                                                <table-column show="id" label="<?php echo e(trans_module_contact_us('admin.id')); ?>"></table-column>
                                                <table-column show="company_name" label="<?php echo e(trans_module_contact_us('admin.company_name')); ?>"></table-column>
                                                <table-column show="country" label="<?php echo e(trans_module_contact_us('admin.country')); ?>"></table-column>
                                                <table-column show="email" label="<?php echo e(trans_module_contact_us('admin.email')); ?>"></table-column>
                                                <table-column show="full_name" label="<?php echo e(trans_module_contact_us('admin.company_name')); ?>"></table-column>
                                                <table-column show="phone" label="<?php echo e(trans_module_contact_us('admin.phone')); ?>"></table-column>
                                                <table-column show="product.name" label="<?php echo e(trans_module_contact_us('admin.favorite_product')); ?>"></table-column>
                                                <table-column show="created_at" label="<?php echo e(trans_module_contact_us('admin.created_at')); ?>"></table-column>
                                                <table-column show="message" label="<?php echo e(trans_module_contact_us('admin.message')); ?>"></table-column>
                                            </table-component>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </contact-us-admin-show>
<?php $__env->stopSection(); ?>


<?php $is_module = true; ?>
<?php $__env->startPush('js_module'); ?>
    <script src="<?php echo e(asset('js/admin/contact_us.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin_panel.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\app\Modules\Contact\resources\views/admin_panel/index.blade.php ENDPATH**/ ?>