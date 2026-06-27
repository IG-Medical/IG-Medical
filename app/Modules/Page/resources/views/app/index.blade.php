@extends('app.layouts.app')

@push('page-title',$pageTitle)


@section('content')
    <main id="main">
        @include('app.layouts.includes.breadcrumbs',['breadcrumb_image'=> $breadcrumb])
        <section class="blog-details mt-3 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mb-4 text-1A5468">{{ $page->title }}</h5>
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/app/page.js') }}"></script>
@endpush
