@extends('app.layouts.app')

@push('page-title',$pageTitle)

@section('content')

    <main id="main">
        @include('app.layouts.includes.breadcrumbs',['breadcrumb_image'=> $breadcrumb])
        <section class="map pb-5">
            <div class="container">
                <div class="section-title">
                    <p>{{ trans_module_distributor('app.ig_world_wide') }}</p>
                </div>

                <div id="map-wrapper" style="width: 100%; height: 400px; margin: auto; border: 1px solid #EEE"></div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection

@push('css')
    <link href="{{ asset_app('vendor/jsvectormap/assets/css/jsvectormap.css') }}" rel="stylesheet">
@endpush

@php $is_module = true; @endphp
@push('before_js')

@endpush
@push('js_module')
    <script src="{{ asset('js/app/distributor.js') }}"></script>
    <script src="{{ asset_app('vendor/jsvectormap/assets/js/jsvectormap.js') }}"></script>
    <script src="{{ asset_app('vendor/jsvectormap/assets/js/world.js') }}"></script>
    <script>
        $(document).ready(function () {
            // https://www.cssscript.com/interactive-vector-map/
            var pinImage = './assets/img/pins/pin.png';

            var trans = {};
            var values = {};
            var country ;
            var name ;

            @foreach($distributors as $distributor)
                @if($distributor->country)
                country ={ {{$distributor->country->iso2}}: "orange" };
                name = { {{$distributor->country->iso2}}: '{{$distributor->country->name}}'}
                values = Object.assign(country,values);
                trans = Object.assign(name,trans);
                @endif
            @endforeach


            var markers = [
                @foreach($distributors as $distributor)
                {
                    name: '{{$distributor->country->name}}',
                    coords: [{{$distributor->lat}}, {{$distributor->long}}],
                    company: {
                        url: '{{route('distributor.details',['country'=>$distributor->country_id])}}',
                        name: '{{ $distributor->title }}',
                        image: '{{$distributor->image_url}}',
                        desc: '{!! $distributor->description !!}',
                    },
                },
                @endforeach
            ];

            var map = new JsVectorMap({
                map: 'world',
                selector: '#map-wrapper',

                regionsSelectable: false,
                markersSelectable: true,

                // -------- Events --------
                onRegionSelected: function (index, isSelected, selectedRegions) {
                    // console.log(index, isSelected, selectedRegions);
                },
                onMarkerSelected: function (index, isSelected, selectedMarkers) {
                    var country = markers[index];
                    if (country) {
                        if (country.company) {
                            var company = country.company;
                            window.open(company.url, '_blank');
                        }
                    }
                },
                onRegionTooltipShow: function (tooltip, index) {
                    $('.jsvmap-tooltip').removeClass('new-w');
                    var country = trans[index];
                    if (country) {
                        tooltip.selector.innerHTML = country
                    }else {
                        return '';
                    }
                },
                onMarkerTooltipShow: function (tooltip, index) {
                    $('.jsvmap-tooltip').addClass('new-w');
                    var country = markers[index];
                    if (country) {
                        if (country.company) {
                            var company = country.company;
                            tooltip.selector.innerHTML = '<div class="MarkerTooltip" style="font-size: smaller;box-shadow: 1px 2px 12px rgb(0 0 0 / 20%);">' +
                                '<div class="member p-4 bg-white">' +
                                '<div class="member-img text-center">' +
                                '<h6><a href="">' + company.name + '</a></h6>' +
                                '<img src="' + company.image + '" class="img-fluid" alt="">' +
                                '</div>' +
                                '<div class="member-info">' +
                                '<span class="details text-dark">' + company.desc + '</span>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        }
                    }

                },
                // -------- Series --------
                series: {
                    // ---------- Region series ----------
                    regions: [
                        {
                            attribute: 'fill',
                            scale: {
                                "orange": "#FD9429",
                            },
                            values: values,
                        },
                    ]
                },
                // -------- Labels --------
                labels: {
                    // markers: {
                    //     render: function (index) {
                    //         return markers[index].name;
                    //     },
                    //     offsets: function (index) {
                    //         return markers[index].offset || [0, 0]
                    //     }
                    // },
                    // regions: {
                    //     render: function (code) {
                    //         var codes = ['EG', 'KZ', 'CN']
                    //
                    //         if (codes.indexOf(code) > -1) {
                    //             return ''
                    //         }
                    //     },
                    // }
                },

                // -------- Region and label style --------
                regionStyle: {
                    initial: {
                        fill: '#a0a0a0'
                    },
                    hover: {
                        fill: "#fcac5b",
                    },
                },
                // regionLabelStyle: {},

                // -------- Marker and label style --------
                markers: markers,
                markerStyle: {
                    initial: {
                        fill: '#ff5566'
                    },
                    hover: {
                        stroke: "#676767",
                        fillOpacity: 1,
                        strokeWidth: 2.5,
                        fill: '#ff5566'
                    },
                    selected: {
                        fill: '#ff5566'
                    }
                },
                markerLabelStyle: {
                    initial: {
                        fontFamily: 'Poppins',
                        fontSize: 14,
                        fontWeight: 500,
                        fill: '#35373e',
                    },
                },
            })
        });
    </script>
@endpush
