Vue.component('page-form1', {
    data() {
        return {
            id: null,
            title: languages(),
            slug: languages(),
            content: languages(),
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            }
        }
    },
    props: {
        page: null,
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
                adminRedirectTo('/pages');
            }).catch(error => {
                hideLoading();
                this.form.disabledButton = false;
                this.form.validation = error.response.data.errors;
                swalError(error);
            });
        },
        reset() {
            this.title = languages();
            this.slug = languages();
            this.slug = '';
            this.content = languages();
            this.form.validation = null;
            this.form.disabledButton = false;
        },
        setNewSlug(newSlug, lang) {
            if (newSlug) {
                this.slug[lang] = newSlug;
            }
        }
    }
});
