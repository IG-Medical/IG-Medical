Vue.component('appearance-certifications-form', {
    data() {
        return {
            route: 'settings',
            certifications: {
                title: languages(),
                content: languages(),
                images: [{
                    name: languages(),
                    image: languages(),
                    image_url: languages(),
                }]
            },
            options: {
                toolbar1: 'formatselect | fontselect | fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | help ',
                language_url: null,
                height: 500,
                images_upload_url: ROOT_URL + '/uploads/editor',
                directionality: LANG === 'ar' ? 'rtl' : 'ltr',  //ltr,rtl
            },
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
            headers: {
                'X-CSRF-TOKEN': TOKN,
            },
            imageLang:LANG,
            show: languages(),
            imgDataUrl: userImageDefault(true)
        }
    },
    props: {
        settings: null,
        page: null,
    },
    mounted() {
        if (this.settings) {
            this.settings.forEach((obj, index) => {
                if (obj.key === 'certifications_page') {
                    this.certifications = obj.value
                }
            });
        }
    },
    methods: {
        addRow() {
            this.certifications.images.push({
                name: languages(),
                image: languages(),
                image_url: languages(),
            });
        },
        deleteRow(index) {
            this.index = index;
            Vue.delete(this.certifications.images, index);
        },
        save() {
            showLoading();
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/store', {
                page: this.page,
                certifications_page: this.certifications,
            }).then(response => {
                this.form.disabledButton = false;
                this.form.loadingDisplay = false;
                swalSuccess(response.data.message);
            }).catch(error => {
                this.form.disabledButton = false;
                this.form.loadingDisplay = false;
                this.form.validation = error.response.data.errors;
                swalError(error);
            })
        },
        reset() {
            this.certifications = {
                title: languages(),
                content: languages(),
                images: [{
                    name: languages(),
                    image: languages(),
                    image_url: languages(),
                }]
            }
        },
        toggleShow(lang = null) {
            this.imageLang = lang;
            this.show[lang] = !this.show[lang];
        },
        cropSuccess(imgDataUrl, field) {
        },
        cropUploadSuccess(jsonData, field) {
            this.imgDataUrl[this.imageLang] = jsonData.file_url;
            this.image[this.imageLang] = jsonData.location;
        },
        cropUploadFail(status, field) {
            swalError(status);
        },
    }
});

