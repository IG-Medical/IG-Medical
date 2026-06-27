Vue.component('appearance-logo', {
    data() {
        return {
            route: 'settings',
            favicon: null,
            favicon_url: null,
            header_logo: null,
            header_logo_url: null,
            footer_logo: null,
            footer_logo_url: null,
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
                if (obj.key === 'footer_logo') {
                    this.footer_logo_url = obj.value;
                    this.footer_logo = obj.value;
                }
                if (obj.key === 'header_logo') {
                    this.header_logo_url = obj.value;
                    this.header_logo = obj.value;
                }
                if (obj.key === 'favicon') {
                    this.favicon_url = obj.value;
                    this.favicon = obj.value;
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
                header_logo: this.header_logo ? this.header_logo.file_link : this.header_logo,
                footer_logo: this.footer_logo ? this.footer_logo.file_link : this.footer_logo,
                favicon: this.favicon ? this.favicon.file_link : this.file_link,
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
        }
    }
});

