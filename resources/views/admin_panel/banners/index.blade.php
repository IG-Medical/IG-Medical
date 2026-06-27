@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="m-portlet m-portlet--full-height">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon"><i class="flaticon-picture"></i></span>
                                <h3 class="m-portlet__head-text">{{ meta('breadcrumbs-title') }}</h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
{{--                            @if($banners->count() < 2)--}}
                                <a href="{{ route_admin('banners.create') }}" class="btn btn-primary">
                                    <i class="la la-plus"></i> {{ trans('admin.add_banner') }}
                                </a>
{{--                            @else--}}
{{--                                <span class="btn btn-secondary" title="{{ trans('admin.max_banners_reached') }}">--}}
{{--                                    <i class="la la-ban"></i> {{ trans('admin.max_banners_reached') }}--}}
{{--                                </span>--}}
{{--                            @endif--}}
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            {{-- <th>{{ trans('admin.title') }}</th> --}}
                                            <th>{{ trans('admin.image') }}</th>
                                            {{-- <th>{{ trans('admin.link') }}</th>
                                            <th>{{ trans('admin.position') }}</th>
                                            <th>{{ trans('admin.status') }}</th> --}}
                                            <th>{{ trans('admin.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($banners as $banner)
                                            <tr>
                                                <td>{{ $banner->id }}</td>
                                                {{-- <td>{{ $banner->title ?? '-' }}</td> --}}
                                                <td>
                                                    @if($banner->image)
                                                        <img src="{{ assetUpload(\App\Models\Banner::DIR_UPLOADS . '/' . $banner->image) }}" alt="" style="max-width: 100px; max-height: 60px;">
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                {{-- <td>{{ $banner->link ?? '-' }}</td>
                                                <td>{{ $banner->position }}</td>
                                                <td>
                                                    @if($banner->is_active)
                                                        <span class="badge badge-success">{{ trans('admin.active') }}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ trans('admin.inactive') }}</span>
                                                    @endif
                                                </td> --}}
                                                <td>
                                                    <a href="{{ route_admin('banners.edit', $banner) }}" class="btn btn-sm btn-info">
                                                        <i class="la la-edit"></i>
                                                    </a>
                                                    <form action="{{ route_admin('banners.destroy', $banner) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('{{ trans('admin.are_you_sure') }}');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="la la-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">{{ trans('admin.no_banners_found') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
