<div>
    <button @if(!empty($key)) @click="toggleShow('{{$key}}')" @else  @click="toggleShow" @endif type="button" class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger">
        <span><i class="la la-cloud-upload"></i></span>{{ isset($label) ? $label : 'Upload'}}
    </button>
    <my-upload field="img"
               @crop-success="cropSuccess"
               @crop-upload-success="cropUploadSuccess"
               @crop-upload-fail="cropUploadFail"
               @if(!empty($key))
               v-model.bool="show['{{$key}}']"
               @else
               v-model.bool="show"
               @endIf
               :width="{{isset($width)?$width:'300'}}"
               :height="{{isset($height)?$height:'300'}}"
               url="{{ isset($url) ? $url :url('uploads/image',['direction' => $DIR_IMAGE_UPLOADS])  }}"
               :headers="headers"
               lang-type="{{ getAppLocale() }}"
               :no-square="true">
    </my-upload>
    <div class="form-control-feedback" v-if="form.validation && (form.validation.img || form.validation.image)">
        <span v-if="form.validation.img" v-text="form.validation.img[0]"></span>
        <span v-else-if="form.validation.image" v-text="form.validation.image[0]"></span>
    </div>
    @if(isset($key))
        <img class="user_profile @if(isset($fluid)) img-fluid @endif" v-if="imgDataUrl && imgDataUrl['{{$key}}']" :src="imgDataUrl['{{$key}}']"width="{{'200'}}" height="{{'130'}}"  style="margin-left: 5%;">
    @else
        <img class="user_profile" v-if="imgDataUrl" :src="imgDataUrl" width="{{'200'}}" height="{{'130'}}" style="margin-left: 5%;">
    @endIf
</div>
