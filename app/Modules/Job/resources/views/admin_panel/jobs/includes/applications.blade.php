<div class="row">
    <div class="col-md-12">
        <div class="m-portlet">
            <div class="m-portlet__body">
                <applications-show  :career="{{ isset($career) ? json_encode($career) : 'null' }}" inline-template>
                   <div>
                       <table-component
                           :data="fetchData"
                           :show-caption="false"
                           ref="table">
                           <table-column show="salutation" label="salutation" :sortable="false"></table-column>
                           <table-column show="full_name" label="Full name" :sortable="false" :filterable="false"></table-column>
                           <table-column show="email" label="email" :sortable="false" :filterable="false"></table-column>
                           <table-column show="phone" label="phone" :sortable="false" :filterable="false"></table-column>
                           <table-column show="street" label="street" :sortable="false" :filterable="false"></table-column>
{{--                           <table-column show="number" label="number" :sortable="false" :filterable="false"></table-column>--}}
{{--                           <table-column show="plz" label="plz" :sortable="false" :filterable="false"></table-column>--}}
{{--                           <table-column show="place_of_residence" label="place_of_residence" :sortable="false" :filterable="false"></table-column>--}}
{{--                           <table-column show="land" label="land" :sortable="false" :filterable="false"></table-column>--}}
                           <table-column show="salary_expectations" label="salary_expectations" :sortable="false" :filterable="false"></table-column>
                           <table-column show="created_at" label="Created At"></table-column>
                           <table-column label="" :sortable="false" :filterable="false">
                               <template slot-scope="row">

                                   <a href="javascript:;"
                                      @click="getDetailsApplication(row.id)"
                                      class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill"
                                      title="Details"><i class="la la-info"></i>
                                   </a>
                               </template>
                           </table-column>
                       </table-component>

                       <el-dialog :visible.sync="dialogVisible" title="Details">
                           <form class="m-form m-form--label-align-right">
                               <div class="m-portlet__body">
                                   <div class="m-section">
                                       <div class="m-section__content">
                                           <table class="table" v-if="application">
                                               <thead>
                                               <tr>
                                                   <th>ID</th>
                                                   <th>@{{ application.id }}</th>
                                               </tr>
                                               </thead>
                                               <tbody>
                                               <tr v-if="application.career">
                                                   <th scope="row">Career</th>
                                                   <td>@{{ application.career}}</td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Salutation</th>
                                                   <td>@{{ application.salutation}}</td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Full name</th>
                                                   <td>@{{ application.full_name}}</td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Email</th>
                                                   <td>@{{ application.email}}</td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Phone</th>
                                                   <td>@{{ application.phone}}</td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Street</th>
                                                   <td>@{{ application.street}}</td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Number</th>
                                                   <td>@{{ application.number}}</td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">PLZ</th>
                                                   <td>@{{ application.plz}}</td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Place of Residence</th>
                                                   <td>@{{ application.place_of_residence}}</td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Land</th>
                                                   <td>@{{ application.land}}</td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Salary Expectations</th>
                                                   <td>@{{ application.salary_expectations}}</td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Earliest Start of Work</th>
                                                   <td>@{{ application.earliest_start_of_work}}</td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Attentive to business through</th>
                                                   <td>@{{ application.attentive_to_business_through}}</td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Curriculum</th>
                                                   <td>
                                                       <template v-if="application.file_curriculum">
                                                           <template v-if="['jpg','jpeg', 'png','PNG','JPEG','JPG'].includes(application.file_curriculum_type)">
                                                               <div class="m-widget5__pic">
                                                                   <a :href="application.file_curriculum" target="_blank">link</a>
{{--                                                                    <img :src="application.file_curriculum" class="m-widget7__img" width="200" height="70">--}}
                                                               </div>
                                                           </template>
                                                           <template v-if="['pdf','doc', 'docx','PDF','DOC','DOCX'].includes(application.file_curriculum_type)">
                                                               <a :href="application.file_curriculum" target="_blank">link</a>
                                                           </template>
                                                       </template>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Testimonials</th>
                                                   <td>
                                                       <template v-if="application.file_testimonials">
                                                           <template v-if="['jpg','jpeg', 'png','PNG','JPEG','JPG'].includes(application.file_testimonials_type)">
                                                               <div class="m-widget5__pic">
                                                                   <a :href="application.file_testimonials" target="_blank">link</a>
{{--                                                                   <img :src="application.file_testimonials" class="m-widget7__img" width="200" height="70">--}}
                                                               </div>
                                                           </template>
                                                           <template v-if="['pdf','doc', 'docx','PDF','DOC','DOCX'].includes(application.file_testimonials_type)">
                                                               <a :href="application.file_testimonials" target="_blank">link</a>
                                                           </template>
                                                       </template>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Miscellaneous</th>
                                                   <td>
                                                       <template v-if="application.file_miscellaneous">
                                                           <template v-if="['jpg','jpeg', 'png','PNG','JPEG','JPG'].includes(application.file_miscellaneous_type)">
                                                               <div class="m-widget5__pic">
{{--                                                                   <img :src="application.file_miscellaneous" class="m-widget7__img" width="200" height="70">--}}
                                                                   <a :href="application.file_miscellaneous" target="_blank">link</a>
                                                               </div>
                                                           </template>
                                                           <template v-if="['pdf','doc', 'docx','PDF','DOC','DOCX'].includes(application.file_miscellaneous_type)">
                                                               <a :href="application.file_miscellaneous" target="_blank">link</a>
                                                           </template>
                                                       </template>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Total Package</th>
                                                   <td>
                                                       <template v-if="application.file_total_package">
                                                           <template v-if="['jpg','jpeg', 'png','PNG','JPEG','JPG'].includes(application.file_total_package_type)">
                                                               <div class="m-widget5__pic">
{{--                                                                   <img :src="application.file_total_package" class="m-widget7__img" width="200" height="70">--}}
                                                                   <a :href="application.file_total_package" target="_blank">link</a>
                                                               </div>
                                                           </template>
                                                           <template v-if="['pdf','doc', 'docx','PDF','DOC','DOCX'].includes(application.file_total_package_type)">
                                                               <a :href="application.file_total_package" target="_blank">link</a>
                                                           </template>
                                                       </template>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Write to</th>
                                                   <td>
                                                       <template v-if="application.file_write_to">
                                                           <template v-if="['jpg','jpeg', 'png','PNG','JPEG','JPG'].includes(application.file_write_to_type)">
                                                               <div class="m-widget5__pic">
{{--                                                                   <img :src="application.file_write_to" class="m-widget7__img" width="200" height="70">--}}
                                                                   <a :href="application.file_write_to" target="_blank">link</a>
                                                               </div>
                                                           </template>
                                                           <template v-if="['pdf','doc', 'docx','PDF','DOC','DOCX'].includes(application.file_write_to_type)">
                                                               <a :href="application.file_write_to" target="_blank">link</a>
                                                           </template>
                                                       </template>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">Internal Application</th>
                                                   <td>
                                                       <template v-if="application.internal_application==1">
                                                           <i class="fa fa-check"></i>
                                                       </template>
                                                       <template v-else>
                                                           <i class="fa fa-times"></i>
                                                       </template>
                                                   </td>

                                               </tr>
                                               <tr>
                                                   <th scope="row">Data Protection</th>
                                                   <td>
                                                       <template v-if="application.data_protection==1">
                                                           <i class="fa fa-check"></i>
                                                       </template>
                                                       <template v-else>
                                                           <i class="fa fa-times"></i>
                                                       </template>
                                                   </td>

                                               </tr>
                                               <tr>
                                                   <th scope="row">Admission to talent pool</th>
                                                   <td>
                                                       <template v-if="application.admission_to_talent_pool==1">
                                                           <i class="fa fa-check"></i>
                                                       </template>
                                                       <template v-else>
                                                           <i class="fa fa-times"></i>
                                                       </template>
                                                   </td>
                                               </tr>
                                               </tbody>
                                           </table>
                                       </div>
                                   </div>
                               </div>
                               <div class="m-portlet__foot m-portlet__foot--fit">
                                   <div class="m-form__actions">
                                       <button type="button" @click="dialogVisible=false" class="btn btn-secondary">Cancel</button>
                                   </div>
                               </div>
                           </form>
                       </el-dialog>
                   </div>
                </applications-show>
            </div>
        </div>
    </div>
</div>
