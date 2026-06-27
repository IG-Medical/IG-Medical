<div class="m-tabs-content__item" id="attributes">
    <h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20">{{trans_module_product('admin.attributes')}}</h4>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group m-form__group">
                <label>{{ trans_module_product('admin.attribute') }}</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-form__group">
                <label>{{ trans_module_product('admin.values') }}</label>
            </div>
        </div>
    </div>
    <div class="row" v-for="(value, index) in rowsAttributes" :key="index">
        <div class="col-md-5 pb-4">
            <el-select v-model="value.attribute_id" :name="`value[${index}][attribute_id]`" placeholder="Select">
                <el-option-group
                    style="width: 100%"
                    v-for="set in attributeSets"
                    :placeholder="'{{trans_module_product('admin.select_option')}}'"
                    :key="set.id"
                    :label="set.label">
                    <el-option
                        v-for="item in set.options"
                        :key="item.id"
                        :label="item.name"
                        :value="item.id">
                    </el-option>
                </el-option-group>
            </el-select>
            <span class="form-control-feedback error-block" v-if="form.validation&&form.validation['rowsAttributes.'.index+'.attribute_id']">@{{ form.validation['rowsAttributes.'.index+'.attribute_id'][0] }}</span>
        </div>
        <div class="col-md-5 pb-4">
            <el-select
                style="width: 100%"
                :id="'id'+index"
                v-model="value.values"
                :name="`value[${index}][values]`"
                multiple
{{--                filterable--}}
                remote
                @focus="onChangeGetValuesSelectElement($event,index)"
                reserve-keyword
                placeholder="Please enter a value"
                :remote-method="getValues"
                :loading="loading">
                <el-option
                    v-for="item in attributeValues"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id">
                </el-option>
            </el-select>
            <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.values">@{{ form.validation.values[0] }}</span>
        </div>
        <div class="col-md-1 pb-4">
            <button  @click="deleteRowAttributes(index)" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill"><span><i class="la la-trash-o"></i><span>{{ trans_module_product('admin.delete') }}</span></span></button>
        </div>
    </div>
    <div class="m-form__group form-group row">
        <label class="col-md-10 col-form-label"></label>
        <div class="col-md-2 pl-0">
            <button @click="addRowAttributes" class="btn btn btn-sm btn-brand m-btn m-btn--icon m-btn--pill m-btn--wide">
                <span><i class="la la-plus"></i><span>{{ trans_module_product('admin.add') }}</span></span>
            </button>
        </div>
    </div>
</div>
