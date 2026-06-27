@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush
@push('css')
    @if(getAppLocale() === 'ar')
        <link href="{{ asset_admin('assets/jsTreeStyle.css')}}" rel="stylesheet" type="text/css" />
    @endif
@endpush
@section('content')
    <categories-index inline-template>
        <div class="m-content">
            <div class="row">
                @include($asRoute.'::admin_panel.includes.data')
                @include($asRoute.'::admin_panel.includes.form')
            </div>
        </div>
    </categories-index>
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/category.js') }}"></script>
@endpush
