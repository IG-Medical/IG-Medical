@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    @include('admin_panel.banners.partials.form', [
        'categories' => $categories
    ])
@endsection
