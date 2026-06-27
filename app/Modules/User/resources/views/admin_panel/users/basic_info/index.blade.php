@extends(ADMIN_VIEWS_DIR.'.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <user-basic-info-form :user="{{ isset($user) ? json_encode($user) : 'null' }}" inline-template>
        <div class="m-content">
            <div class="row">
                @include($asRoute.'::.'.ADMIN_VIEWS_DIR.'.account.sidebar')
                <div class="col-xl-9 col-lg-8">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title"><span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                    <h3 class="m-portlet__head-text">Basic Information</h3>
                                </div>
                            </div>
                        </div>
                        @include($asRoute.'::.'.ADMIN_VIEWS_DIR.'.basic_info.form')
                    </div>
                </div>
            </div>
        </div>
    </user-basic-info-form>
@endsection

@push('js')
<script src="{{ asset('js/admin/user.js') }}"></script>
@endpush
