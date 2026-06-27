@extends('app.layouts.app')

@push('page-title',$pageTitle)

@section('content')
    <main id="main">

        @include('app.layouts.includes.breadcrumbs',[
                    'breadcrumb_image' => isset($category) ? $category->breadcrumb_image_url : null,
                    'video' => [
                        'url' => isset($category) ? $category->breadcrumb_video_url : null,
                        'type' => isset($category) ? $category->breadcrumb_video_type : null,
                    ]
                ])



        <section class="pt-5 pb-5">
            <div class="container">
                <div class="section-title">
                    <p class="text-left">{{$category->name}}</p>
                </div>
                <div class="row">
                    <div class="col-md-8 category_description_m">
                        <p>{!! $category->description !!}</p>
                    </div>
                    <div class="col-md-4">
                        <img src="{{$category->image_url}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= Last gallery Section ======= -->
        <section id="gallery" class="lastNews gallery">
            <div class="container">
                <div class="section-title">
                    <p>{{ trans_module_product('app.models') }}</p>
                </div>
                <div class="row">
                    @foreach($category->products as $prod)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="member" style="min-height: unset">
                            <div class="member-img" style="padding: unset">

                                <img src="{{$prod->main_image_url}}" class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <h4 class="font-size-product" style="white-space: unset; height: 58px;">
                                    {{substr($prod->name,0,35). (strlen($prod->name) > 35 ? '...' : '')}}
                                </h4>
                            </div>
                            <div class="gallery-details text-white text-center">
                                <div class="my-auto">
                                    <a href="{{route('product.details',['slug' => $prod->slug])}}">
                                    <h3 class="fs-16 pb-3">{{$prod->name}}</h3>
                                    <p class="fs-14">
                                     {!! $prod->short_description!!}
                                    </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section><!-- End gallery Section -->
    </main><!-- End #main -->
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/app/product.js') }}"></script>
@endpush
