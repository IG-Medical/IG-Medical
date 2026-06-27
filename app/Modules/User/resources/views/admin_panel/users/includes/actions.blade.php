<span style="overflow:visible; position: relative; width: 110px;">
    <div class="dropdown">
        <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="false">
            <i class="la la-ellipsis-h"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-190px, -59px, 0px);">
{{--            <a :href="`{{ $route }}/${row.id}/basic-info`" target="_blank" class="dropdown-item"><i class="la la-edit"></i> Update Account</a>--}}
            <a v-if="row.status.id!={{ \User\Models\UserStatus::BLOCKED }}" @click="userBlock(row.id, row.full_name)" href="javascript:;" class="dropdown-item" ><i class="la la-ban"></i> Block</a>
            <a v-if="row.status.id=={{ \User\Models\UserStatus::BLOCKED }}" @click="userUnBlock(row.id, row.full_name)" href="javascript:;" class="dropdown-item" ><i class="la la-check-circle"></i> UnBlock</a>
        </div>
    </div>
</span>

<el-tooltip class="item" effect="dark" content="update Add Special Job" placement="top-start">
<div class="col-3" style="padding-left:0px;">
    <span class="m-switch m-switch--icon m-switch--accent">
        <label>
            <input v-if="row.add_special_job==1" type="checkbox" @click="updateAddSpecialJob(row.id)" checked="checked" name="">
            <input v-else type="checkbox" @click="updateAddSpecialJob(row.id)"  name="">
            <span></span>
        </label>
    </span>
</div>
</el-tooltip>
<button @click="deleteUser(row.id, row.full_name)"
        title="Delete"
        class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
    <i class="la la-trash"></i>
</button>
