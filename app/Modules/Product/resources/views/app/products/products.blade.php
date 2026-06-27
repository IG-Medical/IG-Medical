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
        <section>
            <div class="container">
                <div class="section-title">
                    <p class="text-left">{{$pageTitle}}</p>
                </div>
            </div>
        </section>

        <!-- ======= Last gallery Section ======= -->
        <section id="gallery" class="lastNews gallery">
            <div class="container">
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                            <div class="member" style="min-height: unset">
                                <div class="member-img" style="padding: unset">
                                    <img src="{{$category->image_url}}" class="img-fluid" alt="">
                                </div>
                                <div class="member-info">
                                    <h4 class="font-size-product">{{$category->name}}</h4>
                                </div>
                                <div class="gallery-details text-white text-center">
                                    <div class="my-auto">
                                        <a href="{{route('product.category',['category' => $category->slug])}}">
                                            <h3 class="fs-16 pb-3">{{$category->name}}</h3>
                                            <p class="fs-14">{{$category->short_description}}</p>
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
