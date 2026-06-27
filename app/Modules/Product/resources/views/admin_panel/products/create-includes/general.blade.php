<div class="m-tabs-content__item m-tabs-content__item--active" id="general">
    <h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20">{{ trans_module_product('admin.general') }}</h4>
    {!! html_entity_decode(build_fields('name',trans_module_product('admin.product_name'))) !!}
    {!! html_entity_decode(build_fields('short_description',trans_module_product('admin.short_description'),null,'textarea')) !!}
    <div class="row">
        @foreach(languages() as $key => $value)
            <div class="col-md-6 pb-4">
                <div class="form-group m-form__group">
                    <label for="{{'description_'.$key}}">{{ trans_module_product('admin.description') }}</label>
                    <tinymce id="{{'description_'.$key}}" v-model="description.{{$key}}" :other_options="options"></tinymce>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-6 pb-4">
            <div class="form-group m-form__group">
                <label>{{ trans_module_product('admin.categories') }}</label>
                <v-jstree :data="categories" collapse show-checkbox @item-click="nodeClick"></v-jstree>
                <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.category">@{{ form.validation.category[0] }}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 pb-4">
            <label class="m-checkbox">
                <input type="checkbox" v-model="is_active"> {{ trans_module_product('admin.is_enable') }}
                <span></span>
            </label>
            <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.is_active">@{{ form.validation.is_active[0] }}</span>
        </div>
    </div>
</div>
