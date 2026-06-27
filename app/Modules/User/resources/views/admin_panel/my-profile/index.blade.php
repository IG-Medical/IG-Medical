@extends('admin_panel.layouts.app')

@push('page-title')
    {{last(meta('breadcrumbs'))}}
@endpush

@section('content')

    <div class="m-content">
        <div class="row">
            @include($asRoute.'::admin_panel.my-profile.sidebar')
            @if($page === 'change-password')
                @include($asRoute.'::admin_panel.my-profile.change-password')
            @else
                @include($asRoute.'::admin_panel.my-profile.basic-info')
            @endif
        </div>
    </div>
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/user.js') }}"></script>
@endpush
