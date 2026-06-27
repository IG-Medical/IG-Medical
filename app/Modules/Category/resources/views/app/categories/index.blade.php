@extends('app.layouts.app')

@push('page-title',$pageTitle)

@section('content')
    @include('app.layouts.includes.breadcrumbs',[
                  'breadcrumb_image' => isset($category) ? $category->breadcrumb_image_url : null,
                  'video' => [
                      'url' => isset($category) ? $category->breadcrumb_video_url : null,
                      'type' => isset($category) ? $category->breadcrumb_video_type : null,
                  ]
          ])

    <section class="section-content pt-0 pb-5">
        <div class="container">
            <div class="row">
                @php $i= 0; @endphp
                @foreach($allCategories as $category)
                    <div class="col-12 {{ $i != 0 ? 'mt-5' : ''}}">
                        <a href="{{ route('product.index',['category' => $category->slug]) }}">
                            <h6 class="heading-line cd-section-form-title">
{{--                                @if($category->icon_url)--}}
{{--                                    <img src="{{$category->icon_url}}" class="img-as-icon mr-2" alt="">--}}
{{--                                @else--}}
{{--                                    <i class="fas fa-braille mr-2"></i>--}}
{{--                                @endif--}}
                                {{$category->name}}
                            </h6>
                        </a>
                        <hr>
                        @if(count($category->children) > 0)
                            <div class="row">
                                @foreach($category->children as $category1)
                                    <div class="col-md-2 col-6 mt-4">
                                        <ul class="list-unstyled">
                                            <li>
                                                <a href="{{ route('product.index',['category' => $category1->slug]) }}">
                                                <h6 class="text-medium fw-medium">{{$category1->name}}</h6>
                                                </a>
                                            </li>
                                            @foreach($category1->children as $category2)
                                                <li class="pl-2"><a href="{{route('product.index',['category' => $category2->slug])}}">{{$category2->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @php ++$i; @endphp
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('js')

@endpush
