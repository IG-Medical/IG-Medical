Vue.component('appearance-footer-form', {
    data() {
        return {
            route: 'settings',
            footer_about_site: languages(),
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
                if (obj.key === 'footer_about_site') {
                    this.footer_about_site = obj.value
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
                footer_about_site: this.footer_about_site,
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
            this.footer_about_site = languages();
        }
    }
});

