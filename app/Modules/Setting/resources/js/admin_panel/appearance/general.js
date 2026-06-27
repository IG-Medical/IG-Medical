Vue.component('appearance-general-form', {
    data() {
        return {
            route: 'settings',
            site_name: languages(),
            welcome_text: languages(),
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
    created() {
    },
    mounted() {
        if (this.settings) {

            this.settings.forEach((obj, index) => {
                if (obj.key === 'site_name') {
                    this.site_name = obj.value
                }
                if (obj.key === 'welcome_text') {
                    this.welcome_text = obj.value
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
                welcome_text: this.welcome_text,
                site_name: this.site_name,
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
            this.site_name = languages();
            this.welcome_text = languages();
        }
    }
});

