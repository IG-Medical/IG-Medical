<span style="overflow:visible; position: relative; width: 110px;">
    <div class="dropdown">
        <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="false">
            <i class="la la-ellipsis-h"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-190px, -59px, 0px);">
            <a :href="`{{ $route }}/${row.id}/edit`"  class="dropdown-item"><i class="la la-pencil"></i>Edit</a>
            <a :href="`{{ $route }}/${row.id}/view`" target="_blank" class="dropdown-item"><i class="la la-info"></i>Details</a>
        </div>
    </div>
</span>


<button @click="deleteJob(row.id, row.job_title)"
        class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"
        title="Delete"><i class="la la-trash"></i>
</button>
