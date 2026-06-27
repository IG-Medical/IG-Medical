<div class="row">
    <div class="col-md-12">
        <div class="m-portlet">
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="m-form__heading" style="margin-bottom: 20px;">
                            <a href="{{ url_lang() .'/jobs/view/'.$career->slug }}" target="_blank"><h5 class="m-form__heading-title">{{$career->job_title}}</h5></a>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="m-widget12">
                    <div class="m-widget12__item">
                        <span class="m-widget12__text1">Category<br><span>{{ isset($career->category) ? $career->category->name : null }}</span></span>
                        <span class="m-widget12__text2">Location<br><span>{{ $career->location}}</span></span>
                    </div>
                    <div class="m-widget12__item">
                        <span class="m-widget12__text1">Experience<br><span>{{ $career->experience  }}</span></span>
                        <span class="m-widget12__text2">Phone<br><span>{{ $career->phone }}</span></span>
                    </div>
                </div>
                <br><br>
                <div class="m-widget12">
                    <div class="m-widget12__item">
                        <span class="m-widget12__text1">Email <br><span>{{$career->email}}</span></span>
                        <span class="m-widget12__text2">Deadline<br><span>{{$career->deadline }}</span></span>
                    </div>
                </div>
                <div class="m-widget12">
                    <div class="m-widget12__item">
                        <span class="m-widget12__text3">Gender<br><span>{{  $career->gender }}</span></span>
                    </div>
                </div>

                <br><br>
                <div>
                    <div class="m-form__heading" style="margin-bottom: 20px;">
                        <h6 class="m-form__heading-title">Descriptions</h6>
                    </div>
                    <p> {!! $career->description !!}</p>
                </div>
                <br/>

            </div>
        </div>
    </div>
</div>
