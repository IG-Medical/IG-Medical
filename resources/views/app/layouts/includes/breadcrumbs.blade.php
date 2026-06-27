@if(meta('breadcrumbs-title') || meta('breadcrumbs'))
    <section class="breadcrumbs" style="background-image: url('{{ isset($breadcrumb_image['url']) ? $breadcrumb_image['url'] : (isset($breadcrumb_image) ? $breadcrumb_image : asset_app('img/custumized.png')) }}')">
        <div class="container">
            <div class=" justify-content-center align-items-center">

                @isset($video['url'])
                <a href="javascript:;" class="btn btn-warning border-radius-25 mr-4 mt-12rem video-btn" data-toggle="modal" data-src="{{$video['url']}}" data-target="#videoModalBreadcrumbs"><i class="fa fa-play"></i> Watch Video</a>
                @endisset
{{-- && $video['type']==='youtube'--}}
                <h2 @if(isset($video['url']) ) class="mt-2" @endif>
{{--                    {{meta('breadcrumbs-title')}}--}}
                </h2>
{{--                <ol>--}}
{{--                    <li><a href="{{ url('/') }}">{{ trans_app('home') }}</a></li>--}}
{{--                    @foreach(meta('breadcrumbs') as $route_name => $title)--}}
{{--                        <li><a href="{{ $route_name ? $route_name : '#' }}">{{ $title }}</a></li>--}}
{{--                    @endforeach--}}
{{--                </ol>--}}
            </div>
        </div>
    </section>
    @isset($video['url'])

            <div class="modal fade video-modal" id="videoModalBreadcrumbs" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <!-- 16:9 aspect ratio -->
                            <div class="embed-responsive embed-responsive-16by9">
                                @if($video['type']==='youtube')
                                <iframe class="embed-responsive-item" src="{{$video['url']}}" id="video" allowscriptaccess="always" allow="autoplay" allowfullscreen></iframe>
                                @endif
                                @if($video['type']==='iframe')
                                    <video width="100%" controls="">
                                        <source src="{{$video['url']}}" type="video/mp4">
                                        <source src="" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endisset
@endif
@push('js')
    <script>
        var $videoSrc;
        $('.video-btn').click(function () {
            $videoSrc = $(this).data("src");
        });
        // when the modal is opened autoplay it
        $('#videoModalBreadcrumbs').on('shown.bs.modal', function (e) {
// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
            $("#videoModalBreadcrumbs iframe#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        })
        // stop playing the youtube video when I close the modal
        $('#videoModalBreadcrumbs').on('hide.bs.modal', function (e) {
            // a poor man's stop video
            $("#videoModalBreadcrumbs iframe#video").attr('src', '');
        });

    </script>
@endpush
