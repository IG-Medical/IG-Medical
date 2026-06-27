<form class="m-form m-form--fit m--margin-bottom-20" v-if="openAdvancedSearch">
    <div class="row m--margin-bottom-20">
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Job ID</label>
            <input type="text" v-model="filter.job_id" class="form-control m-input" placeholder="E.g: 4590" data-col-index="0">
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Job Title</label>
            <input type="text" v-model="filter.title" class="form-control m-input" placeholder="E.g: Website development" data-col-index="1">
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Descriptions</label>
            <div class="m-input-icon m-input-icon--left">
                <input type="text" v-model="filter.descriptions" class="form-control m-input" placeholder="E.g: website development...">
            </div>
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Salary Range</label>

                <select class="form-control" v-model="filter.salary">
                    <option value="">Select Type</option>
                    @foreach($salaryRanges as $range)
                        <option value="{{$range->id}}">{{$range->range}}</option>
                    @endforeach
                </select>
        </div>
    </div>

    <div class="row m--margin-bottom-20">
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Company Industry</label>
            <select class="form-control" v-model="filter.company_industry">
                <option value="">Select Company Industry</option>
                @foreach($companyIndustry as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Location</label>
            <multiselect :options="{{ $countries->toJson() }}"
                         v-model="filter.country"
                         label="name"
                         track-by="id"
                         :multiple="false"
                         :show-label="false"
                         :searchable="true"
                         :close-on-select="true">
            </multiselect>
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Remote Career</label>
                <div class="col-3">
                    <span class="m-switch m-switch--info">
                        <label>
                            <input type="checkbox" v-model="filter.remote_career" name="">
                            <span></span>
                        </label>
                    </span>

            </div>
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Career Level</label>
            <select class="form-control" v-model="filter.level">
                <option value="">Select Type</option>
                @foreach($levels as $level)
                    <option value="{{$level->id}}">{{$level->name}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="row m--margin-bottom-20">
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Owner ID </label>
            <div class="m-input-icon m-input-icon--left">
                <input type="text" v-model="filter.user_id" class="form-control m-input" placeholder="E.g: 123...">
            </div>
        </div>

        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Owner Wallet ID</label>
            <div class="m-input-icon m-input-icon--left">
                <input type="text" v-model="filter.wallet_id" class="form-control m-input" placeholder="E.g: 1PAL5fb21e647237a...">
            </div>
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Owner Full Name</label>
            <div class="m-input-icon m-input-icon--left">
                <input type="text" v-model="filter.full_name" class="form-control m-input" placeholder="E.g: Alhassan Fayyad...">
            </div>
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Email Owner</label>
            <div class="m-input-icon m-input-icon--left">
                <input type="text" v-model="filter.email" class="form-control m-input" placeholder="E.g: alhassanfayyad@gmail.com...">
                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="flaticon-email"></i></span></span>
            </div>
        </div>
    </div>
    <div class="row m--margin-bottom-20">
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Professions</label>
            <multiselect :options="{{ isset($professions) ? $professions->toJson() : '[]' }}"
                         v-model="filter.professions"
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
                         v-model="filter.skills"
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
            <label>Date Created</label>
            <el-date-picker
                    v-model="filter.created_at"
                    type="date"
                    style="width: 100%;"
                    value-format="yyyy-MM-dd"
                    placeholder="E.g: 1996-02-23">
            </el-date-picker>
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Date Of Publication</label>
            <el-date-picker
                    v-model="filter.date_publication"
                    type="date"
                    style="width: 100%;"
                    value-format="yyyy-MM-dd"
                    placeholder="E.g: 1996-02-23">
            </el-date-picker>
        </div>
    </div>

    <div class="row m--margin-bottom-20">

        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Status</label>
            <select class="form-control" v-model="filter.status">
                <option value="">Select Job Status</option>
                @foreach($status as $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Number Of Applicants</label>
            <div class="input-daterange input-group">
                <input type="text" v-model="filter.number_of_applicants.from" class="form-control m-input" placeholder="From" data-col-index="5" />
                <div class="input-group-append">
                    <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                </div>
                <input type="text" v-model="filter.number_of_applicants.to" class="form-control m-input" placeholder="To" data-col-index="5" />
            </div>
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