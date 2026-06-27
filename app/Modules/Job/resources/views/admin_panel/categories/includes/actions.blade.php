@include(ADMIN_VIEWS_DIR.'.partials.buttons.edit',['asRoute' => 'categories'])
<button @click="deleteItem(row.id, row.title)" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air" title="Delete">
    <i class="la la-trash"></i>
</button>
