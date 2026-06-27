Vue.component('page-form', {
    data() {
        return {
            id: null,
            title: languages(),
            slug: '',
            content: languages(),
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
            options: {
                toolbar1: 'formatselect | fontselect | fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | help ',
                height: 500,
                images_upload_url: ROOT_URL + '/uploads/editor',
                directionality: LANG === 'ar' ? 'rtl' : 'ltr',  //ltr,rtl
                language_url: null,
            }
        }
    },
    props: {
        page: null,
    },
    created() {
        if (LANG === 'ar') {
            this.options.language_url = '/app/tinymce_languages/langs/ar.js';
        }
    },
    mounted() {
        if (this.page) {
            this.id = this.page.id;
            this.title = this.page.title;
            this.content = this.page.content;
            this.slug = this.page.slug;
        }
    },
    methods: {
        save() {
            showLoading();
            this.form.disabledButton = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/pages/store', {
                id: this.id,
                title: this.title,
                slug: this.slug,
                pContent: this.content,
            }).then(response => {
                this.reset();
                swalSuccess(response.data.message);
                adminRedirectTo('pages');
            }).catch(error => {
                hideLoading();
                this.form.disabledButton = false;
                this.form.validation = error.response.data.errors;
                swalError(error);
            });
        },
        reset() {
            this.title = languages();
            this.slug = '';
            this.content = languages();
            this.form.validation = null;
            this.form.disabledButton = false;
        },
        setNewSlug(newSlug, lang) {
            if (newSlug) {
                this.slug = newSlug;
            }
        }
    }
});
