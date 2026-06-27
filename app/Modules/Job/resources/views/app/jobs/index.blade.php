@extends('app.layouts.app')

@push('page-title',$pageTitle)


@section('content')
    <main id="main">

        @include('app.layouts.includes.breadcrumbs',['breadcrumb_image'=> $breadcrumb])
        <jobs-show inline-template>
            <section id="careersPage-search" class="careersPage-search">
                <div class="container">
                    <div class="section-title" data-aos="zoom-out">
                        <p>@{{ jobs.length }} {{ trans_module_job('app.job_listed_here') }}</p>
                    </div>
                    <form class="col-md-9 mx-auto">
                        <div class="form-row  align-items-center">
                            <div class="col">
                                <select class="form-control" v-model="filter.category">
                                    <option v-for="(category,index) in categories" :value="category.id">@{{ category.title }}</option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="text" v-model="filter.location" class="form-control" placeholder="{{ trans_module_job('app.job_location') }}">
                            </div>
                            <div class="col-auto">
                                <button type="button" @click="fetchData" class="btn btn-warning-search text-uppercase">{{ trans_module_job('app.search') }}</button>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-3">
                        <div class="col-md-4 col-12 mt-3" v-for="(job,index) in jobs">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title">@{{ job.job_title }}</p>
                                    <h6 class="card-subtitle mb-3 mt-3 text-muted">
                                        <span class="time mr-5">@{{ job.status }}</span>
                                        <span><i class="ri-time-line"></i>@{{ job.humans_date_publication }}</span>
                                    </h6>
                                    <p class="card-text pt-2 pb-2" v-html="job.description.substring(0,165)"></p>
                                    <a :href="`{{ route_app('job.view') }}/${job.slug}`" class="btn btn-outline-warning-apply btn-sm d-block mt-5">{{ trans_module_job('app.apply_now') }}</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </jobs-show>
    </main><!-- End #main -->
@endsection

@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/app/job.js') }}"></script>
@endpush

