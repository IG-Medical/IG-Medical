@extends('app.layouts.app')

@push('page-title',$pageTitle)


@section('content')
    <main id="main">
        @include('app.layouts.includes.breadcrumbs',['breadcrumb_image'=> $breadcrumb])
        <section class="blog-details mt-3 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mb-4 text-1A5468">{{$news->title}}</h5>
                        @isset($news->image_url[getAppLocale()])
                        <div class="w-100">
                            <img src="{{$news->image_url[getAppLocale()]}}" class="img-fluid" alt="">
                        </div>
                        @endisset
                        <div class="w-100 mt-4 mb-4 new_details">
                          {!! $news->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/app/news.js') }}"></script>
@endpush
