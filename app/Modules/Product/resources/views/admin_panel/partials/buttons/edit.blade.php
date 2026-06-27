@php $module = isset($route) ? $route : $asRoute;@endphp
<a :href="`{{  \Str::plural($module) }}/${row.id}/edit`"
   class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="{{trans('admin.edit')}}">
    <i class="la la-pencil"></i>
</a>
