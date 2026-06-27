<?php echo $__env->make($asRoute.'::admin_panel.partials.buttons.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<button @click="deleteItem(row.id, row.title)"
        title="<?php echo e(trans('admin.delete')); ?>"
        class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
    <i class="la la-trash"></i>
</button>
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\app\Modules\News\resources\views/admin_panel/includes/actions.blade.php ENDPATH**/ ?>