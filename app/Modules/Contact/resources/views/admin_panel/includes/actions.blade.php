@include($asRoute.'::admin_panel.partials.buttons.edit')
<button @click="deleteItem(row.id, row.caption_1)"
        title="{{trans('admin.delete')}}"
        class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
    <i class="la la-trash"></i>
</button>
