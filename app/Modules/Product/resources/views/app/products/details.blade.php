@extends('app.layouts.app')

@push('page-title',$pageTitle)

@section('content')
    <main id="main">
        @include('app.layouts.includes.breadcrumbs',[
                'breadcrumb_image' => isset($product->category) ? $product->category->breadcrumb_image_url : null,
                'video' => [
                    'url' => isset($product->category) ? $product->category->breadcrumb_video_url : null,
                    'type' => isset($product->category) ? $product->category->breadcrumb_video_type : null,
                ]
        ])

        <section class="pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <aside class="col-md-5 mb-4">
                        <div class="">
                            <article class="gallery-wrap">
                                <div class="img-big-wrap card">
                                    <div class="my-gallery one-gallery-owl-carousel owl-carousel">
                                        @if($product->youtube)
                                            <div class="h-100 w-100 d-flex" style="justify-content: center;text-align: center;">
                                                <img id="imageZoom" class="gallery-image item" src="http://img.youtube.com/vi/{{ str_replace('https://www.youtube.com/embed/','', $product->youtube) }}/0.jpg">
                                                <a href="javascript:;" class="btn btn-warning border-radius-25 mr-4 mt-4 video-btn position-absolute" style="top: 32%;" data-toggle="modal" data-src="{{$product->youtube}}" data-target="#videoModalProduct"><i class="fa fa-play"></i></a>
                                            </div>
                                        @elseif($product->icon_url)
                                            <div class="h-100 w-100 d-flex" style="justify-content: center;text-align: center;">
                                                <img id="imageZoom" class="gallery-image item" src="{{ asset_app('img/images_prview_viedo.png') }}">
                                                <a href="javascript:;" class="btn btn-warning border-radius-25 mr-4 mt-4 video-btn position-absolute" style="top: 32%;" data-toggle="modal" data-src="{{$product->icon_url}}" data-target="#videoModalProduct"><i class="fa fa-play"></i></a>
                                            </div>
                                        @endif
                                        @foreach($product->gallery as $img)
                                            <img id="imageZoom" class="gallery-image item" src="{{$img->url}}">
                                        @endforeach
                                    </div>
                                </div> <!-- slider-product.// -->
                                <div class="thumbs-wrap my-gallery-owl-carousel owl-carousel">
                                    @if($product->youtube)
                                        <div>
                                            <a href="javascript:;" class="item-thumb item item-video justify-content-center pt-0">

                                                <img id="imageZoom" class="gallery-image item" src="http://img.youtube.com/vi/{{ str_replace('https://www.youtube.com/embed/','', $product->youtube) }}/0.jpg">
                                                <i class="fa fa-play-circle position-absolute text-white" style="top: 28%;"></i>
                                            </a>
                                        </div>
                                    @elseif($product->icon_url)
                                        <div>
                                            <a href="javascript:;" class="item-thumb item item-video justify-content-center pt-0">
                                                <img id="imageZoom" class="gallery-image item" src="{{ asset_app('img/images_prview_viedo.png') }}">
                                                <i class="fa fa-play-circle position-absolute text-white" style="top: 28%;"></i>
                                            </a>
                                        </div>
                                    @endif
                                    @foreach($product->gallery as $img)
                                    <a href="javascript:;" class="item-thumb item"> <img src="{{$img->url}}"></a>
                                    @endforeach
                                </div> <!-- slider-nav.// -->
                            </article> <!-- gallery-wrap .end// --> <!-- card.// -->
                        </div>

                    </aside>
                    <div class="col-md-7">
                        <h5 class="mb-4">{{$product->name}}</h5>
                        <div class="product-details">
                            <p class="text-828282">{{$product->category->name}}</p>
                            <p class="text-828282">
                                {!! $product->description !!}
                            </p>
                            {{--                            <div>--}}
                            {{--                                <ol>--}}
                            {{--                                    <li>--}}
                            {{--                                        High resolution TFT touch screen--}}
                            {{--                                        <p>with auto screen layout</p>--}}
                            {{--                                    </li>--}}
                            {{--                                    <li>--}}
                            {{--                                        High storage capacity:--}}
                            {{--                                        <p>Up to 2 hours single-channel ECG data storage</p>--}}
                            {{--                                        <p>Up to 480h trend/graphic storage and review</p>--}}
                            {{--                                    </li>--}}
                            {{--                                    <li>Resting 12-channel ECG analysis</li>--}}
                            {{--                                    <li>Suitable for adult, peadiatric and neonate patients</li>--}}
                            {{--                                    <li>Displays up to 13 waveforms at once</li>--}}
                            {{--                                    <li>Easy drug calculation interface</li>--}}
                            {{--                                    <li>S-T segment analysis and more than 23 tpyes of arrhythmia analysis</li>--}}
                            {{--                                    <li>Bed to bed view for comfortable patient visit</li>--}}
                            {{--                                    <li>Visual and audible alarms</li>--}}
                            {{--                                    <li>Defibrillator discharge protection</li>--}}
                            {{--                                    <li>--}}
                            {{--                                        Rechargeable and exchangeable batteriy--}}
                            {{--                                        <p>up to 10 hours working time</p>--}}
                            {{--                                    </li>--}}
                            {{--                                </ol>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="product-more-details pb-5 pt-2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="accordion" id="accordionProducts">
                            <div class="card mt-2">
                                <div class="card-header-number">
                                    <h5>1</h5>
                                </div>
                                <div class="w-100">
                                    <div class="card-header" id="headingTwo">

                                        <button class="btn btn-link text-decoration-none text-191919 w-100 collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            <h5 class="mb-0 d-flex justify-content-between fs-16">{{ trans_module_product('app.basic_configuration') }} <i class="fa fa-angle-down" aria-hidden="true"></i></h5>
                                        </button>
                                        {{--                                            <button class="btn btn-link text-191919 collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"></button>--}}

                                    </div>

                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionProducts">
                                        <div class="card-body pt-0 basic-configuration">
                                            {!! $product->basic_configuration !!}
                                        </div>
                                    </div>

                                </div>
                            </div>

                            @php $i=1 @endphp
                            @if(count($attributesProduct['attribute']) > 0)
                                @foreach($attributesProduct['attribute'] as  $attribute)
                                    @php ++$i @endphp
                                    <div class="card {{$i != 0 ? 'mt-2' : ''}}">
                                        <div class="card-header-number">
                                            <h5>{{$i}}</h5>
                                        </div>
                                        <div class="w-100">
                                            <div class="card-header" id="heading{{$i}}">

                                                    <button class="btn btn-link text-decoration-none text-191919 w-100 collapsed" type="button"
                                                            data-toggle="collapse"
                                                            data-target="#collapse{{$i}}"
                                                            aria-expanded="true"
                                                            aria-controls="collapse{{$i}}">
                                                        <h5 class="mb-0 d-flex justify-content-between fs-16">
                                                            {{$attribute[0]['attribute_set_name']}} <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                        </h5>

                                                    </button>
{{--                                                    <button class="btn btn-link text-191919 collapsed" type="button" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}"><i class="fa fa-angle-down" aria-hidden="true"></i></button>--}}

                                            </div>


                                            <div id="collapse{{$i}}" class="collapse" aria-labelledby="heading{{$i}}" data-parent="#accordionProducts">
                                                <div class="card-body pt-0">
                                                    <table class="table table-striped">
                                                        <tbody>
                                                        @foreach($attribute as $att)
                                                        <tr>
                                                            <th>{{$att['name']}}</th>
                                                            <td>
                                                                @foreach($attributesProduct['values'] as  $key => $value)
                                                                    @foreach($value as  $key => $v)
                                                                        @if($v['attribute_id'] === $att['id'])
                                                                        {{$v['name']}}
                                                                            @if(count($value)-1>$key)
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="col-12">
                        <a href="{{route('customized.index',['id'=>$product->id])}}" class="btn btn-warning border-radius-25 mr-md-4 mr-0 mt-4">Customized</a>
                        @if($product->pdf)
                        <a href="javascript:;" class="btn btn-outline-warning border-radius-25 mr-md-4 mr-0 mt-4" data-toggle="modal" data-target="#modalDownload">{{ trans_module_product('app.download_pdf') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="ads">
            <div class="container">
                <div class="row">
                    <div class="col-md-7"></div>
                    <div class="col-md-5">
                        <div class="mt-5">
{{--                            <h5 class="text-1A5468 text-center">{{ trans_module_product('app.we_operate_24_a_day') }}</h5>--}}

{{--                            <p class="text-center">{{ trans_module_product('app.our_pleasure') }}</p>--}}

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->


    <div class="modal fade video-modal" id="videoModalProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        @if($product->youtube)
                        <iframe class="embed-responsive-item" src="{{$product->youtube}}" id="video" allowscriptaccess="always" allow="autoplay" allowfullscreen></iframe>
                        @elseif($product->icon_url)
                            <video width="100%" controls="" id="video-id">
                                <source src="{{$product->icon_url}}" type="video/mp4" id="video">
                                <source src="" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <download-pdf-product :product="{{isset($product) ? json_encode($product) : 'null'}}" inline-template>
        <div class="modal fade modal-download" id="modalDownload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center">Download</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
{{--                        <div class="form-group">--}}
{{--                            <input type="text"  v-model="surname" class="form-control fs-14 bg-F8F8F8" placeholder="Surname">--}}
{{--                            <span class="error" v-if="form.validation&&form.validation.surname">@{{ form.validation.surname[0] }}</span>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <input type="text"  v-model="first_name" class="form-control fs-14 bg-F8F8F8" placeholder="{{ trans_module_product('app.name') }}">
                            <span class="error" v-if="form.validation&&form.validation.first_name">@{{ form.validation.first_name[0] }}</span>
                        </div>
                        <div class="form-group">
                            <input type="text"  v-model="email" class="form-control fs-14 bg-F8F8F8" placeholder="{{ trans_module_product('app.email') }}">
                            <span class="error" v-if="form.validation&&form.validation.email">@{{ form.validation.email[0] }}</span>
                        </div>
                        <div class="form-group">
                            <input type="text" v-model="company" class="form-control fs-14 bg-F8F8F8" placeholder="{{ trans_module_product('app.company') }}">
                            <span class="error" v-if="form.validation&&form.validation.company">@{{ form.validation.company[0] }}</span>
                        </div>
                        <div class="form-group">
                            <multiselect :options="{{ $countries->toJson() }}"
                                         v-model="country_id"
                                         label="name"
                                         track-by="id"
                                         :multiple="false"
                                         :show-label="false"
                                         :searchable="true"
                                         :close-on-select="true"
                                         placeholder="{{ trans_module_product('app.choose_the_country') }}">
                            </multiselect>
                            <span class="error" v-if="form.validation&&form.validation.country_id">@{{ form.validation.country_id[0] }}</span>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <input type="text" v-model="department" class="form-control fs-14 bg-F8F8F8" placeholder="Department">--}}
{{--                            <span class="error" v-if="form.validation&&form.validation.department">@{{ form.validation.department[0] }}</span>--}}
{{--                        </div>--}}


                        <div class="form-group">
                            <input type="text"  v-model="phone" class="form-control fs-14 bg-F8F8F8" placeholder="{{ trans_module_product('app.phone') }}">
                            <span class="error" v-if="form.validation&&form.validation.phone">@{{ form.validation.phone[0] }}</span>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" v-model="i_agree" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">I have read and taken note of the Igmedical <a href="" class="text-primary">privacy policy</a></label>
                            <span class="error" v-if="form.validation&&form.validation.i_agree">@{{ form.validation.i_agree[0] }}</span>
                        </div>
                        <div class="form-group text-center mb-0">
                            <button type="button" @click="download" :disabled="form.disabledButton" class="btn btn-warning border-radius-25 mr-md-4 mr-0 mt-4">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </download-pdf-product>
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/app/product.js') }}"></script>
    <script>
        // Gets the video src from the data-src on each button
        var $videoSrc;
        $('.video-btn').click(function () {
            $videoSrc = $(this).data("src");
        });
        // when the modal is opened autoplay it
        $('#videoModalProduct').on('shown.bs.modal', function (e) {
        // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
            $("#videoModalProduct iframe#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        })


            // stop playing the youtube video when I close the modal
            $('#videoModalProduct').on('hide.bs.modal', function (e) {

                $('.video-id').each(function(){
                    $(this).stopVideo();
                });

                // a poor man's stop video
                $("#videoModalProduct iframe#video").attr('src', '');
                @if(!$product->youtube)
                    var media = $("#video-id").get(0);
                    media.pause();
                    media.currentTime = 0;
                @endif
            });

        var o1 = $('.one-gallery-owl-carousel');
        var o2 = $('.my-gallery-owl-carousel');
        o2.owlCarousel({
            loop:false,
            nav:true,
            dots: false,
            // autoWidth:true,
            items:1,
            margin:2.5,
            responsive: {
                0: {
                    items: 3,
                    loop: false,
                    nav:true,
                    margin: 2,
                },
                767: {
                    items: 3,
                    loop: false,
                    nav:true,
                    margin: 2,
                },
                768: {
                    items: 6,
                    loop: false,
                    nav:true,
                    dots: false,
                    margin: 2.5,
                }
            }
        });
        o1.owlCarousel({
            loop:false,
            nav:false,
            dots: false,
            // autoWidth:true,
            items:1,
            margin:0,
        });

        $('.my-gallery-owl-carousel .owl-item').on('click', function(event) {
            var _index = $(this).index();
            o1.trigger('to.owl.carousel', _index);
        });
    </script>
@endpush
