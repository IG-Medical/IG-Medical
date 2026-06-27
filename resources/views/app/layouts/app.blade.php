<!DOCTYPE html>
<html dir="{{ getAppLocale() == 'ar' ? 'rtl' : 'ltr' }}">
@include('app.layouts.includes.head')
<body>
@include('app.layouts.includes.header')

<div id="app" v-cloak>
    @yield('content')

    @stack('content_more')
    @include('app.layouts.includes.footer')

    <div class="modal fade video-modal" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>



@include('app.layouts.includes.js')
@include('app.layouts.includes.alert')
@stack('js')
</body>
</html>
