<form class="m-form m-form--fit m--margin-bottom-20" v-if="openAdvancedSearch">
    <div class="row m--margin-bottom-20">
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>UserID</label>
            <input type="text" v-model="filter.user_id" class="form-control m-input" placeholder="E.g: 4590" data-col-index="0">
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>WalletID</label>
            <input type="text" v-model="filter.wallet_id" class="form-control m-input" placeholder="E.g: 1PAL5fb21e647237a" data-col-index="1">
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Full Name</label>
            <input type="text" v-model="filter.full_name" class="form-control m-input" placeholder="E.g: Alhassan Fayyad" data-col-index="1">
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Email</label>
            <div class="m-input-icon m-input-icon--left">
                <input type="text" v-model="filter.email" class="form-control m-input" placeholder="E.g: alhassanfayyad@gmail.com">
                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="flaticon-email"></i></span></span>
            </div>
        </div>
    </div>
    <div class="row m--margin-bottom-20">
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Mobile</label>
            <vue-tel-input class="form-control m-input"
                           @input="onInputMobile"
                           v-model="filter.showMobile"
                           :ignored-countries="['IL']"
                           :dropdown-options="{showDialCodeInSelection:true,showFlags:true}"
                           :auto-default-country="false"
                           :valid-characters-only="true"
                           :preferred-countries="['DE']">
            </vue-tel-input>
{{--            <div class="m-input-icon m-input-icon--left">--}}
{{--                <input type="text" class="form-control m-input" placeholder="E.g: +970592503412">--}}
{{--                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-mobile"></i></span></span>--}}
{{--            </div>--}}
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Job Title</label>
            <input type="text" v-model="filter.job_title" class="form-control m-input" placeholder="E.g: BackEnd Web Developer" data-col-index="4">
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Hourly Price</label>
            <div class="input-daterange input-group" id="m_datepicker">
                <input type="text" v-model="filter.hourly_price.from" class="form-control m-input" name="start" placeholder="From" data-col-index="5" />
                <div class="input-group-append">
                    <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                </div>
                <input type="text" v-model="filter.hourly_price.to" class="form-control m-input" name="end" placeholder="To" data-col-index="5" />
            </div>
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Date of Registration</label>
            <el-date-picker
                    v-model="filter.created_at"
                    type="date"
                    style="width: 100%;"
                    value-format="yyyy-MM-dd"
                    placeholder="E.g: 1996-02-23">
            </el-date-picker>
        </div>
    </div>
    <div class="row m--margin-bottom-20">
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>City</label>
            <input type="text" v-model="filter.city" class="form-control m-input" placeholder="E.g: Gaza" data-col-index="1">
        </div>

{{--            <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">--}}
{{--                <label>Date of Birth</label>--}}
{{--                <el-date-picker--}}
{{--                        v-model="filter.date_birth"--}}
{{--                        type="date"--}}
{{--                        style="width: 100%;"--}}
{{--                        value-format="yyyy-MM-dd"--}}
{{--                        placeholder="Date of Birth">--}}
{{--                </el-date-picker>--}}
{{--            </div>--}}

        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Gender</label>
            <select id="gender" v-model="filter.gender" class="form-control">
                <option value="">Choose the gender</option>
                @foreach(genders() as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>	&nbsp;</label>
            <div class="m-checkbox-list">
                <label class="m-checkbox m-checkbox--bold m-checkbox--state-brand">
                    <input type="checkbox" v-model="filter.verify_mobile"> The Mobile Has Been Verified
                    <span></span>
                </label>
                <label class="m-checkbox m-checkbox--bold m-checkbox--state-brand">
                    <input type="checkbox" v-model="filter.verify_email"> Email Has Been Verified
                    <span></span>
                </label>
                <!---------------->
                <label class="m-checkbox m-checkbox--bold m-checkbox--state-brand">
                    <input type="checkbox" v-model="filter.un_verify_mobile"> Didn't verify the phone number
                    <span></span>
                </label>
                <label class="m-checkbox m-checkbox--bold m-checkbox--state-brand">
                    <input type="checkbox" v-model="filter.un_verify_email"> Didn't verify the email
                    <span></span>
                </label>
            </div>
        </div>
    </div>
    <div class="row m--margin-bottom-20">
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Role</label>
            <select class="form-control" v-model="filter.type">
                <option value="">Select Role</option>
                @if(isset($_userTypes) && count($_userTypes) > 0)
                    @foreach($_userTypes as $type)
                        <option value="{{ $type->id }}" >{{ $type->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Status</label>
            <select class="form-control" v-model="filter.status">
                <option value="">Select User Status</option>
                @foreach($userStatus as $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Profile Completion Rate</label>
            <div class="input-daterange input-group" id="m_datepicker">
                <input type="text" v-model="filter.profile_completion_rate.from" class="form-control m-input" placeholder="From" data-col-index="5" />
                <div class="input-group-append">
                    <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                </div>
                <input type="text" v-model="filter.profile_completion_rate.to" class="form-control m-input" placeholder="To" data-col-index="5" />
            </div>
        </div>
    </div>
    <div class="row m--margin-bottom-20">
{{--        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">--}}
{{--            <label>Rating</label>--}}
{{--            <div class="input-daterange input-group" id="m_datepicker">--}}
{{--                <select class="form-control" v-model="filter.rating.from">--}}
{{--                    <option value="">Select...</option>--}}
{{--                    @for($i=1; $i<=5;$i++)--}}
{{--                        <option value="{{ $i }}">{{ $i}}</option>--}}
{{--                    @endfor--}}
{{--                </select>--}}
{{--                <div class="input-group-append">--}}
{{--                    <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>--}}
{{--                </div>--}}
{{--                <select class="form-control" v-model="filter.rating.to">--}}
{{--                    <option value="">Select...</option>--}}
{{--                    @for($i=1; $i<=5;$i++)--}}
{{--                        <option value="{{ $i }}">{{ $i}}</option>--}}
{{--                    @endfor--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">--}}
{{--            <label>Number Of Ratings</label>--}}
{{--            <input type="number" v-model="filter.number_of_ratings" class="form-control m-input" placeholder="E.g: 213" data-col-index="1">--}}
{{--        </div>--}}
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>The Number Of Completed Projects</label>
            <input type="number" v-model="filter.number_of_completed_projects" class="form-control m-input" placeholder="E.g: 213" data-col-index="1">
        </div>

        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                <label>Professions</label>
                <multiselect :options="professions"
                             v-model="filter.userProfessionsSelected"
                             label="name"
                             track-by="id"
                             :multiple="true"
                             :show-label="false"
                             :searchable="true"
                             :close-on-select="true"
                             placeholder="Search">
                </multiselect>
        </div>

        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Skills</label>
            <multiselect :options="skills"
                         v-model="filter.userSkillsSelected"
                         label="name"
                         track-by="id"
                         :multiple="true"
                         :show-label="false"
                         :searchable="true"
                         :close-on-select="true"
                         placeholder="Search">
            </multiselect>
        </div>
    </div>
    <div class="m-separator m-separator--md m-separator--dashed"></div>
    <div class="row">
        <div class="col-lg-12">
            <button type="button" @click="doFilter" class="btn btn-brand m-btn m-btn--icon" id="m_search"><span><i class="la la-search"></i><span>Search</span></span></button>
            <button type="button" @click="resetFilter" class="btn btn-secondary m-btn m-btn--icon" id="m_reset"><span><i class="la la-close"></i><span>Reset</span></span></button>
        </div>
    </div>
</form>
