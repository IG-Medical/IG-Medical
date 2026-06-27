<div class="m-tabs-content__item" id="images">
    <h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20">{{ trans_module_product('admin.images') }}</h4>
    <div class="row">
        <div class="col-md-6 pb-4">
            <div class="form-group m-form__group">
                <label for="icon">{{ trans_module_product('admin.video') }}</label>
                <upload-file :file.sync="icon"
                             :type-extension="['mp4']"
                             placeholder="{{ trans_module_product('admin.video') }}"
                             upload="{{$DIR_UPLOADS}}"
                             id="icon"
                             :value-prop="{name:'{{ trans_module_product('admin.video') }}',path:icon_url}">
                </upload-file>
                <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.icon">@{{ form.validation.icon[0] }}</span>
            </div>
        </div>
        <div class="col-md-6 pb-4">
            <div class="form-group m-form__group">
{{--                @include('admin_panel.partials.image_upload',['url' => route('upload.uploadFileOnCrop',['dir' => $DIR_UPLOADS]),'width' => 270,'height'=> 180])--}}

                <label for="main_image">{{ trans_module_product('admin.main_image') }}</label>
                <upload-file :file.sync="main_image"
                             :type-extension="['jpg', 'jpeg', 'png']"
                             placeholder="{{ trans_module_product('admin.main_image') }}"
                             upload="{{$DIR_UPLOADS}}"
                             id="main_image"
                             :value-prop="{name:'{{ trans_module_product('admin.main_image') }}',path:main_image_url}">
                </upload-file>
                <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.main_image">@{{ form.validation.main_image[0] }}</span>
            </div>
        </div>
        <div class="col-md-6 pb-4">
            <div class="form-group m-form__group">
                <label for="image">{{ trans_module_product('admin.image_gallery') }}</label>
                <el-multiple-file-upload
                    :upload="'{{$DIR_UPLOADS}}'"
                    :attachments-files.sync="image_gallery">
                </el-multiple-file-upload>
                <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.image_gallery">@{{ form.validation.image_gallery[0] }}</span>
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-12">
            <label>{{ trans_module_product('admin.youtube') }}</label>
            <input type="text" v-model="youtube" class="form-control m-input"/>
            <span class="form-control-feedback" v-if="form.validation&&form.validation.youtube">@{{ form.validation.youtube[0] }}</span>
        </div>
    </div>
    <div class="col-md-6 pb-4 row">
        <div class="form-group m-form__group">
            <label for="pdf">{{ trans_module_product('admin.pdf') }}</label>
            <upload-file :file.sync="pdf"
                         :type-extension="['pdf']"
                         placeholder="{{ trans_module_product('admin.pdf') }}"
                         upload="{{$DIR_UPLOADS}}"
                         id="pdf"
                         :value-prop="{name:'{{ trans_module_product('admin.pdf') }}',path:pdf_url}">
            </upload-file>
            <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.pdf">@{{ form.validation.pdf[0] }}</span>
        </div>
    </div>
</div>
