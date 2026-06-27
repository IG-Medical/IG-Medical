<div class="col-md-4">
    <div class="m-portlet m-portlet--full-height ">
        <div class="m-portlet__body">
{{--            <button @click="addRootCategory" class="btn m-btn m-btn--gradient-from-primary m-btn--gradient-to-info">--}}
{{--                <span><i class="fa fa-plus"></i><span> {{trans_module_category('admin.create_root')}}</span></span>--}}
{{--            </button>--}}
            <button @click="addSubCategory" :disabled="form.disabledButtonSubCategory" class="btn m-btn m-btn--gradient-from-primary m-btn--gradient-to-info">
                <span><i class="fa fa-plus"></i><span> {{trans_module_category('admin.create_sub')}}</span></span>
            </button>
            <hr>
            <template v-if="categories.length>0">
                <a href="javascript:;" @click="collapseAll">{{trans_module_category('admin.collapse_all')}}</a> |
                <a href="javascript:;" @click="expandAll">{{trans_module_category('admin.expand_all')}}</a>
            </template>

            <v-jstree :data="categories" @item-click="nodeClick" collapse></v-jstree>
        </div>
    </div>
</div>
