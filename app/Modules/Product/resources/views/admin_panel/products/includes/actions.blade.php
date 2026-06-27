@php $module = isset($moduleNamespace) ? $moduleNamespace : $asRoute;@endphp
{{-- Edit button: always visible --}}
@include($module.'::admin_panel.partials.buttons.edit')

@php
    // Get the base URL for product routes (e.g., /en/admin/products or /admin/products)
    $baseUrl = rtrim(route_admin($module . '.index'), '/');
@endphp

{{-- Delete button: shown when NOT trashed --}}
<template v-if="!row.deleted_at">
    <form :action="`{{ $baseUrl }}/${row.id}/delete`" method="POST" style="display: inline-block;"
          data-confirm-title="{{ trans_module_product('admin.confirm_delete') }}"
          data-confirm-icon="warning"
          data-confirm-yes="{{ trans_module_product('admin.yes') }}"
          data-confirm-no="{{ trans_module_product('admin.no') }}">
        @csrf
        @method('DELETE')
        <button type="button"
                title="{{ trans_module_product('admin.delete') }}"
                class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill product-action-confirm">
            <i class="la la-trash"></i>
        </button>
    </form>
</template>

{{-- Restore button: shown when trashed --}}
<template v-if="row.deleted_at">
    <form :action="`{{ $baseUrl }}/${row.id}/restore`" method="POST" style="display: inline-block;"
          data-confirm-title="{{ trans_module_product('admin.confirm_restore') }}"
          data-confirm-icon="question"
          data-confirm-yes="{{ trans_module_product('admin.yes') }}"
          data-confirm-no="{{ trans_module_product('admin.no') }}">
        @csrf
        @method('PUT')
        <button type="button"
                title="{{ trans_module_product('admin.restore') }}"
                class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill product-action-confirm">
            <i class="la la-undo"></i>
        </button>
    </form>
</template>

{{-- Force delete button: shown when trashed --}}
<template v-if="row.deleted_at">
    <form :action="`{{ $baseUrl }}/${row.id}/force-delete`" method="POST" style="display: inline-block;"
          data-confirm-title="{{ trans_module_product('admin.confirm_force_delete') }}"
          data-confirm-icon="error"
          data-confirm-yes="{{ trans_module_product('admin.yes') }}"
          data-confirm-no="{{ trans_module_product('admin.no') }}">
        @csrf
        @method('DELETE')
        <button type="button"
                title="{{ trans_module_product('admin.force_delete') }}"
                class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill product-action-confirm">
            <i class="la la-trash"></i>
        </button>
    </form>
</template>

@push('js')
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
@endpush
