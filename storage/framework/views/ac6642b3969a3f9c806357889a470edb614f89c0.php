<?php $module = isset($moduleNamespace) ? $moduleNamespace : $asRoute;?>

<?php echo $__env->make($module.'::admin_panel.partials.buttons.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    // Get the base URL for product routes (e.g., /en/admin/products or /admin/products)
    $baseUrl = rtrim(route_admin($module . '.index'), '/');
?>


<template v-if="!row.deleted_at">
    <form :action="`<?php echo e($baseUrl); ?>/${row.id}/delete`" method="POST" style="display: inline-block;"
          data-confirm-title="<?php echo e(trans_module_product('admin.confirm_delete')); ?>"
          data-confirm-icon="warning"
          data-confirm-yes="<?php echo e(trans_module_product('admin.yes')); ?>"
          data-confirm-no="<?php echo e(trans_module_product('admin.no')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="button"
                title="<?php echo e(trans_module_product('admin.delete')); ?>"
                class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill product-action-confirm">
            <i class="la la-trash"></i>
        </button>
    </form>
</template>


<template v-if="row.deleted_at">
    <form :action="`<?php echo e($baseUrl); ?>/${row.id}/restore`" method="POST" style="display: inline-block;"
          data-confirm-title="<?php echo e(trans_module_product('admin.confirm_restore')); ?>"
          data-confirm-icon="question"
          data-confirm-yes="<?php echo e(trans_module_product('admin.yes')); ?>"
          data-confirm-no="<?php echo e(trans_module_product('admin.no')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <button type="button"
                title="<?php echo e(trans_module_product('admin.restore')); ?>"
                class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill product-action-confirm">
            <i class="la la-undo"></i>
        </button>
    </form>
</template>


<template v-if="row.deleted_at">
    <form :action="`<?php echo e($baseUrl); ?>/${row.id}/force-delete`" method="POST" style="display: inline-block;"
          data-confirm-title="<?php echo e(trans_module_product('admin.confirm_force_delete')); ?>"
          data-confirm-icon="error"
          data-confirm-yes="<?php echo e(trans_module_product('admin.yes')); ?>"
          data-confirm-no="<?php echo e(trans_module_product('admin.no')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="button"
                title="<?php echo e(trans_module_product('admin.force_delete')); ?>"
                class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill product-action-confirm">
            <i class="la la-trash"></i>
        </button>
    </form>
</template>

<?php $__env->startPush('js'); ?>
<script>
(function() {
    document.addEventListener('click', function(ev) {
        var btn = ev.target.closest('.product-action-confirm');
        if (!btn) return;
        var form = btn.closest('form');
        if (!form || !form.hasAttribute('data-confirm-title')) return;
        ev.preventDefault();
        var title = form.getAttribute('data-confirm-title');
        var iconType = form.getAttribute('data-confirm-icon') || 'warning';
        var confirmColor = iconType === 'error' ? '#d33' : (iconType === 'question' ? '#28a745' : '#3085d6');
        var opts = {
            title: title,
            showCancelButton: true,
            confirmButtonColor: confirmColor,
            cancelButtonColor: '#6c757d',
            confirmButtonText: form.getAttribute('data-confirm-yes') || 'Yes',
            cancelButtonText: form.getAttribute('data-confirm-no') || 'Cancel'
        };
        opts.type = iconType;
        var fire = (typeof Swal !== 'undefined' && Swal.fire) ? Swal.fire.bind(Swal) : (typeof swal !== 'undefined' ? swal : null);
        if (fire) {
            fire(opts).then(function(r) {
                if (r && (r.isConfirmed === true || r.value === true)) form.submit();
            });
        } else {
            form.submit();
        }
    });
})();
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\app\Modules\Product\resources\views/admin_panel/products/includes/actions.blade.php ENDPATH**/ ?>