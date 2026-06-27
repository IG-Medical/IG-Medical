Vue.component('appearance-titles-form', {
    data() {
        return {
            route: 'settings',
            home_page_about_us_section: {
                title: languages(),
                sub_title: languages(),
                content: languages(),
            },
            home_page_product_section: {
                title: languages(),
                sub_title: languages(),
            },
            home_page_companies_section: {
                title: languages(),
                sub_title: languages(),
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
        }
    },
    props: {
        settings: null,
        page: null,
    },
    mounted() {
        if (this.settings) {

            this.settings.forEach((obj, index) => {
                if (obj.key === 'home_page_about_us_section') {
                    this.home_page_about_us_section = obj.value;
                }
                if (obj.key === 'home_page_product_section') {
                    this.home_page_product_section = obj.value;
                }
                if (obj.key === 'home_page_companies_section') {
                    this.home_page_companies_section = obj.value;
                }
            });
        }
    },
    methods: {
        save() {
            showLoading();
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/store', {
                page: this.page,
                home_page_about_us_section: this.home_page_about_us_section,
                home_page_product_section: this.home_page_product_section,
                home_page_companies_section: this.home_page_companies_section,
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
            this.home_page_about_us_section = languages();
            this.home_page_product_section = languages();
            this.home_page_companies_section = languages();
        }
    }
});

