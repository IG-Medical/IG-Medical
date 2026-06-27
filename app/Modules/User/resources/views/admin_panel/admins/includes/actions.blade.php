@include('admin_panel.partials.buttons.edit')
<button @click="deleteItem(row.id, row.full_name)"
        title="{{trans_module_user('admin.delete')}}"
        class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
    <i class="la la-trash"></i>
</button>
