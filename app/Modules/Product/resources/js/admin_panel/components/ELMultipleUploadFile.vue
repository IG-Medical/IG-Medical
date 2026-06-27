<template>
  <div>
    <el-upload
        :accept="accept"
        :action="action"
        :before-remove="beforeRemove"
        :before-upload="beforeUpload"
        :file-list="filesList"
        :headers="headers"
        :on-exceed="handleExceed"
        :on-error="handleError"
        :on-preview="handlePreview"
        :on-remove="handleRemove"
        :on-success="handleUploadSuccess"
        class="upload-demo"
        multiple
        drag
        ref="upload"
    >
      <i class="el-icon-upload"></i>
      <div class="el-upload__text" v-html="$t('drop_file_here_or_click_to_upload')"></div>
      <div class="el-upload__tip" slot="tip">
        <span>{{
            $t('upload_images_will_be_displayed', {
              type: ".jpg, .gif, or .png",
              up_to: '10',
              wide: '690',
              up_to_2: '25'
            })
          }}</span>
        <br>
        <br>
        <span><b>{{ $t('attachments') }}</b></span>
      </div>
    </el-upload>
  </div>
</template>

<script>
export default {
  props: {upload: '', attachmentsFiles: null, type: '',},
  data() {
    return {
      filesList: [],
      innerFilesList: [],
      action: '',
      isInit: false,
      accept: '*',
      headers: {
        'X-CSRF-TOKEN': TOKN,
      },
    };
  },
  watch: {
    attachmentsFiles: function (val) {
      if (typeof val != 'undefined') {
        if (val && this.isInit) {
          this.isInit = false;
          this.innerFilesList = [...val];
          this.fileList = [...val];
        } else if (val.length == 0) {
          this.$refs.upload.clearFiles();
        }
      }
    }
  },
  mounted() {
    if (this.type == 'image')
      this.accept = 'image/jpeg,image/gif,image/png,image/jpg';

    if (this.type == 'application')
      this.accept = 'application/pdf,.doc,.docx';

    if (this.type == 'all')
      this.accept = 'application/pdf,.doc,.docx,image/jpeg,image/gif,image/png,image/jpg';

    this.action = ROOT_URL + '/uploads/file?upload=' + this.upload;
    this.isInit = true;

    setTimeout(() => {
      this.filesList = this.attachmentsFiles;
    }, 1000);
  },
  methods: {
    handleRemove(file, fileList) {
      //this.filesList.splice(this.filesList.indexOf(file), 1);
      this.innerFilesList.splice(this.innerFilesList.indexOf(file), 1);
      this.$emit('update:attachmentsFiles', this.innerFilesList);
    },
    handlePreview(file, fileList) {
      const previewFile = file.response ? file.response.url : file.url;
      window.open(previewFile);
    },
    handleExceed(files, fileList) {
      // toastWarning(`The limit is 1`);
      // this.$message.warning(`The limit is 1`);
    },
    beforeRemove(file, fileList) {
      this.isInit = true;
      return this.$confirm(this.$t('Cancel_the_transfert_of_file_name', {file_name: file.name}), this.$t('Warning'), {
        confirmButtonText: this.$t('OK'),
        cancelButtonText: this.$t('Cancel'),
        type: 'warning'
      });
    },
    beforeUpload(file, fileList) {
      if (this.type == 'image') {
        if (file.type !== 'image/jpeg' &&
            file.type !== 'image/jpg' &&
            file.type !== 'image/gif' &&
            file.type !== 'image/png') {
          Vue.$toast.error(this.$t('Upload_file_can_only_be_in_picture_format'), {duration: 5000});
          this.$refs.upload.clearFiles();
        }
      }
      if (this.type == 'image&application') {
        if (file.type !== 'application/pdf' &&
            file.type !== 'image/jpeg' &&
            file.type !== 'image/jpg' &&
            file.type !== 'image/gif' &&
            file.type !== 'image/png') {
          Vue.$toast.error(this.$t('Upload_file_can_only_be_format'), {duration: 5000});
          this.$refs.upload.clearFiles();
        }
      }

      if (this.type == 'application') {
        if (file.type !== 'application/pdf' &&
            file.type !== 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
          Vue.$toast.error(this.$t('Upload_file_can_only_be_in_format'), {duration: 5000});
          this.$refs.upload.clearFiles();
        }
      }
    },
    handleUploadSuccess(response, file) {
      this.isInit = true;
      this.innerFilesList.push(response);
      this.$emit('update:attachmentsFiles', this.innerFilesList);
    },
    handleError(err, file, fileList) {
      Vue.$toast.error(this.$t('uploadfailed'), {duration: 5000});
    }
  }
}
</script>

<style>
/*.el-upload-list{*/
/*    width: 50%;*/
/*}*/
/*.el-upload, .el-upload-dragger{*/
/*    width: 100% !important;*/
/*}*/
</style>
