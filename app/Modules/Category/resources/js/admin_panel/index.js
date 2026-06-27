import VJstree from 'vue-jstree'
import myUpload from 'vue-image-crop-upload/upload-2.vue';

Vue.component('categories-index', {
    data() {
        return {
            route: 'categories',
            page_title: this.$t('create_root'),
            id: null,
            name: languages(),
            short_description: languages(),
            description: languages(),
            parent_id: null,
            root_id: null,
            root_name: '',
            icon: null,
            icon_url: null,
            image: null,
            image_url: null,
            breadcrumb_image: null,
            breadcrumb_video: null,
            breadcrumb_video_upload: null,
            breadcrumb_video_upload_url: null,
            breadcrumb_image_url: null,
            is_featured: false,
            is_active: false,
            is_searchable: false,
            form: {
                validation: null,
                disabledButton: false,
                disabledButtonSubCategory: true,
                loadingDisplay: false,
            },
            category: null,
            categories: [],
            options: {
                toolbar1: 'formatselect | fontselect | fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | help ',
                language_url: null,
                height: 500,
                images_upload_url: ROOT_URL + '/uploads/editor',
                directionality: LANG === 'ar' ? 'rtl' : 'ltr',  //ltr,rtl
            },
            headers: {
                'X-CSRF-TOKEN': TOKN,
            },
            showIcon: false,
            showImage: false,
            showBreadcrumbImage: false,
            iconDataUrl: userImageDefault(), // the base64 url of created image
            imgDataUrl: userImageDefault(), // the base64 url of created image
            imgBreadcrumbDataUrl: userImageDefault(), // the base64 url of created image
        }
    },
    components: {
        VJstree,
        myUpload
    },
    mounted() {
        this.fetchData();
    },
    watch:{
        image:function (val) {
            if(val&&val.path) {
                this.image_url = val.path;
            }
        }
    },
    methods: {
        each(data, bool) {
            $.each(data, (index, obj) => {
                obj.opened = bool;
                if (obj.hasOwnProperty('children')) {
                    this.each(obj.children, bool);
                }
            })
        },
        collapseAll() {
            $.each(this.categories, (index, obj) => {
                obj.opened = false;

                if (obj.hasOwnProperty('children')) {
                    this.each(obj.children, false);
                }
            });
        },
        expandAll() {
            $.each(this.categories, (index, obj) => {
                obj.opened = true;

                if (obj.hasOwnProperty('children')) {
                    this.each(obj.children, true);
                }
            });
        },
        setCategory() {
            this.id = this.category.id;
            this.name = this.category.name;
            this.parent_id = this.category.parent_id;
            this.icon = this.category.icon;
            this.breadcrumb_image = this.category.breadcrumb_image;
            this.imgBreadcrumbDataUrl = this.category.breadcrumb_image_url;
            this.breadcrumb_image_url = this.category.breadcrumb_image_url;
            this.image = this.category.image;
            this.image_url = this.category.image_url;
            this.imgDataUrl = this.category.image_url;

            if (this.category.breadcrumb_video_type === 'iframe') {
                this.breadcrumb_video_upload = this.category.breadcrumb_video;
                this.breadcrumb_video_upload_url = this.category.breadcrumb_video_url;
            }

            if (this.category.breadcrumb_video_type === 'youtube') {
                this.breadcrumb_video = this.category.breadcrumb_video;
            }

            this.icon_url = this.category.icon_url;
            this.iconDataUrl = this.category.icon_url;
            this.is_active = this.category.is_active;
            this.is_featured = this.category.is_featured;
            this.is_searchable = this.category.is_searchable;
            this.short_description = this.category.short_description;
            this.description = this.category.description;
            // this.breadcrumb_video = this.category.breadcrumb_video;
        },
        getCategoryById(category_id) {
            showLoading();
            axios.get(ADMIN_URL + '/' + this.route + '/' + category_id + '/get', {
                params: {}
            }).then(response => {
                hideLoading();
                this.category = response.data.data;
                this.setCategory();
            }).catch(error => {
                hideLoading();
            });
        },
        nodeClick(node) {
            if (node.model.parent_id === null) {
                this.root_id = null;
                this.category = null;
            }
            let category_id = node.model.id;
            this.page_title = this.$t('edit') + ' ' + node.model.text;
            this.form.disabledButtonSubCategory = false;
            this.getCategoryById(category_id);
        },
        addRootCategory() {
            showLoading();
            this.root_id = null;
            this.category = null;
            this.page_title = this.$t('create_root');
            this.reset();
            setTimeout(() => {
                hideLoading();
            }, 100)
        },
        addSubCategory() {
            this.root_id = this.category.id;
            this.root_name = this.category.name[LANG];
            this.page_title = this.$t('create_sub_to') + ' ' + this.root_name;
            this.reset();
        },
        save() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            let  breadcrumb_video_upload = this.handlerBreadcrumbVideoUpload();

            axios.post(ADMIN_URL + '/' + this.route + '/store', {
                id: this.id,
                short_description: this.short_description,
                description: this.description,
                name: this.name,
                root_id: this.root_id,
                parent_id: this.parent_id,
                image: this.handlerImage(),
                icon: this.handlerIcon(),
                breadcrumb_image: this.handlerBreadcrumbImage(),
                breadcrumb_video_upload: breadcrumb_video_upload,
                is_searchable: this.is_searchable,
                is_featured: this.is_featured,
                is_active: this.is_active,
                breadcrumb_video: this.breadcrumb_video,
            }).then(response => {
                this.reset();
                swalSuccess(response.data.message);
                this.fetchData();
                // adminRedirectTo(this.route);
            }).catch(error => {
                this.form.disabledButton = false;
                this.form.loadingDisplay = false;
                this.form.validation = error.response.data.errors;
                swalError(error);
            })
        },
        handlerImage() {
            if (this.image != null)
                return this.image = this.image['file_link'] ? this.image['file_link'] : this.image

            return this.image
        },
        handlerIcon() {
            if (this.icon != null)
                return this.icon = this.icon['file_link'] ? this.icon['file_link'] : this.icon
            return this.icon;
        },
        handlerBreadcrumbImage() {
            if (this.breadcrumb_image != null)
                return this.breadcrumb_image = this.breadcrumb_image['file_link'] ? this.breadcrumb_image['file_link'] : this.breadcrumb_image
            return this.breadcrumb_image;
        },
        handlerBreadcrumbVideoUpload() {
            if (this.breadcrumb_video_upload != null)
                return this.breadcrumb_video_upload = this.breadcrumb_video_upload['file_link'] ? this.breadcrumb_video_upload['file_link'] : this.breadcrumb_video_upload

            if (this.breadcrumb_video_upload && this.breadcrumb_video_upload['file_link'] == null) {

                delete this.breadcrumb_video_upload['file_link'];
                delete this.breadcrumb_video_upload['name'];
                delete this.breadcrumb_video_upload['path'];
                this.breadcrumb_video_upload_url = null;
                return this.breadcrumb_video_upload = null;
            }

            return this.breadcrumb_video_upload;
        },
        reset() {
            this.id = null;
            this.name = languages();
            this.short_description = languages();
            this.is_searchable = false;
            this.is_featured = false;
            this.is_active = false;
            this.parent_id = null;
            this.icon = null;
            this.breadcrumb_video_upload = null;
            this.breadcrumb_video_upload_url = null;
            this.breadcrumb_image = null;
            this.breadcrumb_image_url = null;
            this.image = null;
            this.image_url = null;
            this.breadcrumb_video = null;
            this.icon_url = null;
            this.form.validation = null;
            this.form.disabledButton = false;
            this.form.loadingDisplay = false;
        },
        fetchData() {
            showLoading();
            axios.get(ADMIN_URL + '/' + this.route + '/data', {}).then(response => {
                hideLoading();
                this.categories = response.data.data;
            }).catch(error => {
                hideLoading();
            });
        },
        listenerImage() {
            this.handlerImage();
        },
        listenerIcon() {
            this.handlerIcon();
        },
        deleteItem() {
            Swal.fire({
                title: this.$t('art_you_delete', {name: this.category.name[LANG]}),
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.value) {
                    showLoading();
                    axios.delete(ADMIN_URL + "/" + this.route + "/" + this.category.id + "/delete").then(response => {
                        hideLoading();
                        sweetAlertDelete(response.data.message);
                        this.addRootCategory();
                        this.fetchData();
                    }).catch(error => {
                        hideLoading();
                        swalError(error);
                    });
                }
            });
        },
        toggleShowIcon(key = null) {
            this.showIcon = !this.showIcon;
        },
        cropSuccessIcon(imgDataUrl, field) {
            console.log('-------- crop success --------');
            this.iconDataUrl = imgDataUrl;
        },
        cropUploadSuccessIcon(jsonData, field) {
            console.log('-------- upload success --------');
            this.icon = jsonData.location;
        },
        cropUploadFailIcon(status, field) {
            console.log('-------- upload fail --------');
            swalError(status);
        },

        toggleShowImage(key = null) {
            this.showImage = !this.showImage;
        },
        cropSuccessImage(imgDataUrl, field) {
            console.log('-------- crop success --------');
            this.imgDataUrl = imgDataUrl;
        },
        cropUploadSuccessImage(jsonData, field) {
            console.log('-------- upload success --------');
            this.image = jsonData.location;
        },
        cropUploadFailImage(status, field) {
            console.log('-------- upload fail --------');
            swalError(status);
        },

        toggleShowBreadcrumbImage(key = null) {
            this.showBreadcrumbImage = !this.showBreadcrumbImage;
        },
        cropSuccessBreadcrumbImage(imgDataUrl, field) {
            console.log('-------- crop success --------');
            this.imgBreadcrumbDataUrl = imgDataUrl;
        },
        cropUploadSuccessBreadcrumbImage(jsonData, field) {
            console.log('-------- upload success --------');
            this.breadcrumb_image = jsonData.location;
        },
        cropUploadFailBreadcrumbImage(status, field) {
            console.log('-------- upload fail --------');
            swalError(status);
        },
        listenerBreadcrumbVideoUpload(e) {
            this.breadcrumb_video_upload = null;
            this.breadcrumb_video_upload_url = null;
        }
        //
    }
});
