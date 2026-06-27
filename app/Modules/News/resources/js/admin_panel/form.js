import myUpload from 'vue-image-crop-upload/upload-2.vue';

Vue.component('news-form', {
    data() {
        return {
            id: null,
            title: languages(),
            short_content: languages(),
            slug: '',
            content: languages(),
            image: languages(),
            image_url: languages(),
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
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
            imageLang:LANG,
            show: languages(),
            imgDataUrl: userImageDefault(true)
        }
    },
    components: {
        myUpload
    },
    props: {
        news: null,
    },
    created() {
        if (LANG === 'ar') {
            this.options.language_url = '/app/tinymce_languages/langs/ar.js';
        }
    },
    mounted() {
        if (this.news) {
            this.id = this.news.id;
            this.title = this.news.title;
            this.short_content = this.news.short_content;
            this.content = this.news.content;
            this.slug = this.news.slug;
            this.image = this.news.image;
            $.each(this.news.image_url, (index, value) => {
                this.image_url[index] = value;
                this.imgDataUrl[index] = value;
            });
        }
    },
    methods: {
        save() {
            showLoading();
            this.form.disabledButton = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/news/store', {
                id: this.id,
                title: this.title,
                slug: this.slug,
                image: this.handlerImage(),
                pContent: this.content,
                short_content: this.short_content,
            }).then(response => {
                this.reset();
                swalSuccess(response.data.message);
                adminRedirectTo('news');
            }).catch(error => {
                hideLoading();
                this.form.disabledButton = false;
                this.form.validation = error.response.data.errors;
                swalError(error);
            });
        },
        handlerImage() {
            $.each(this.image, (index, value) => {
                if (this.image[index] && this.image[index]['file_link']) {
                    this.image[index] = this.image[index]['file_link'] ? this.image[index]['file_link'] : this.image[index];
                }
            });
            return this.image;
        },
        reset() {
            this.title = languages();
            this.slug = '';
            this.content = languages();
            this.image = languages();
            this.short_content = languages();
            this.form.validation = null;
            this.form.disabledButton = false;
        },
        setNewSlug(newSlug, lang) {
            if (newSlug) {
                this.slug = newSlug;
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
