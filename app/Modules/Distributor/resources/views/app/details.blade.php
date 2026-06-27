@extends('app.layouts.app')

@push('page-title',$pageTitle)

@section('content')

    <main id="main">
        @include('app.layouts.includes.breadcrumbs')
        <section class="lastNews companies-list mt-5">
            <div class="container">
                <div class="section-title">
{{--                    <p>New Jersey </p>--}}
                </div>

                <div class="row">
                    @foreach($distributors as $distributor)
                    <div class="col-lg-4 col-md-6 mt-2 d-flex align-items-stretch">
                        <div class="member aos-init aos-animate" data-aos="fade-up">
                            <div class="member-img text-center">
                                <h6><a href="">{{$distributor->title}}</a></h6>
                                <img src="{{$distributor->image_url}}" class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                            <span class="details">
                               {!! $distributor->description !!}
                            </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection


@php $is_module = true; @endphp
@push('before_js')

@endpush
@push('js_module')
    <script src="{{ asset('js/app/distributor.js') }}"></script>

@endpush
