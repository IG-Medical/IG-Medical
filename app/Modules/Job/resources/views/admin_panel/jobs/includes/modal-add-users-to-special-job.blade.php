<div class="form-group m-form__group row">
    <div class="col-md-12">
        <label>Users</label>
        <multiselect v-model="selectUser"
                     placeholder="Type Name , Email,  Id to search"
                     id="ajax"
                     label="full_name"
                     :multiple="true"
                     track-by="id"
                     :options="users"
                     :loading="isLoading"
                     :internal-search="false"
                     @search-change="getUsers">
        </multiselect>
    </div>
</div>

<div class="modal-footer">
    <button type="button" @click="dialogVisibleAddUsersToSpecialJob=false" class="btn btn-secondary">Cancel</button>
    <button type="button" @click="addUsersToSpecialJob" :disabled="form.disabledButton" class="btn btn-primary">Save</button>
</div>
