<?php $__env->startPush('page-title'); ?>
    <?php echo e(last(meta('breadcrumbs'))); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <product-form :product="<?php echo e(isset($product) ? json_encode($product) : 'null'); ?>" inline-template>
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-portlet m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text"><?php echo e(last(meta('breadcrumbs'))); ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="row">
                                <div class="col-xl-3">
                                    <div class="m-tabs" data-tabs="true" data-tabs-contents="#m_sections">
                                        <ul class="m-nav m-nav--active-bg m-nav--active-bg-padding-lg m-nav--font-lg m-nav--font-bold m--margin-bottom-20 m--margin-top-10 m--margin-right-40" id="m_nav" role="tablist">
                                            <li class="m-nav__item">
                                                <a class="m-nav__link m-tabs__item m-tabs__item--active" data-tab-target="#general" href="#">
                                                    <span class="m-nav__link-text"><?php echo e(trans_module_product('admin.general')); ?></span>
                                                </a>
                                            </li>

                                            <li class="m-nav__item">
                                                <a class="m-nav__link  m-tabs__item" data-tab-target="#images" href="#images">
                                                    <span class="m-nav__link-text"><?php echo e(trans_module_product('admin.images')); ?></span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a class="m-nav__link  m-tabs__item" data-tab-target="#attributes" href="#attributes">
                                                    <span class="m-nav__link-text"><?php echo e(trans_module_product('admin.attributes')); ?></span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a class="m-nav__link  m-tabs__item" data-tab-target="#basic_configuration" href="#basic_configuration">
                                                    <span class="m-nav__link-text"><?php echo e(trans_module_product('admin.basic_configuration')); ?></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xl-9">
                                    <div class="m-tabs-content" id="m_sections">
                                        <?php echo $__env->make($asRoute.'::admin_panel.products.create-includes.general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make($asRoute.'::admin_panel.products.create-includes.images', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make($asRoute.'::admin_panel.products.create-includes.attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make($asRoute.'::admin_panel.products.create-includes.basic-configuration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                </div>
                            </div>
                            <form class="m-form m-form--label-align-left- m-form--state-">
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions m-form__action">
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="row col-md-6">
                                                <?php echo $__env->make($asRoute.'::admin_panel.partials.buttons.save', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php echo $__env->make($asRoute.'::admin_panel.partials.buttons.reset', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </product-form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <style>
        .border-options {
            border: 1px solid #ccc!important;
            padding: 22px;
            border-radius: 16px;
            margin-bottom: 3rem;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $is_module = true; ?>
<?php $__env->startPush('js_module'); ?>
    <script src="<?php echo e(asset('js/admin/product.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin_panel.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\app\Modules\Product\resources\views/admin_panel/products/create.blade.php ENDPATH**/ ?>