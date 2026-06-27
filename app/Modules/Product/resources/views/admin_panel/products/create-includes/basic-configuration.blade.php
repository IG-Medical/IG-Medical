<div class="m-tabs-content__item" id="basic_configuration">
    <h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20">{{trans_module_product('admin.basic_configuration')}}</h4>

    <div class="m-form__group form-group row">
        <label class="col-md-10 col-form-label"></label>
        @foreach(languages() as $key => $value)
            <div class="col-md-6 pb-4">
                <div class="form-group m-form__group">
                    <label for="{{'basic_configuration'.$key}}">{{ trans_module_product('admin.basic_configuration') }}</label>
                    <tinymce id="{{'basic_configuration'.$key}}" v-model="basic_configuration.{{$key}}" :other_options="options"></tinymce>
                </div>
            </div>
        @endforeach
    </div>
</div>
