<div class="col-md-4">
    <div class="m-portlet m-portlet--full-height ">
        <div class="m-portlet__body">



            <button @click="addSubCategory" :disabled="form.disabledButtonSubCategory" class="btn m-btn m-btn--gradient-from-primary m-btn--gradient-to-info">
                <span><i class="fa fa-plus"></i><span> <?php echo e(trans_module_category('admin.create_sub')); ?></span></span>
            </button>
            <hr>
            <template v-if="categories.length>0">
                <a href="javascript:;" @click="collapseAll"><?php echo e(trans_module_category('admin.collapse_all')); ?></a> |
                <a href="javascript:;" @click="expandAll"><?php echo e(trans_module_category('admin.expand_all')); ?></a>
            </template>

            <v-jstree :data="categories" @item-click="nodeClick" collapse></v-jstree>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\app\Modules\Category\resources\views/admin_panel/includes/data.blade.php ENDPATH**/ ?>