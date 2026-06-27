Vue.component('setting-custom-css-js', {
    data() {
        return {
            route: 'settings',
            asset_custom: {
                header: '',
                footer: '',
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
                if (obj.key === 'custom_header')
                    this.asset_custom.header = obj.value;

                if (obj.key === 'custom_footer')
                    this.asset_custom.footer = obj.value;
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
                custom_header: this.asset_custom.header,
                custom_footer: this.asset_custom.footer,
                page: this.page,
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
            this.asset_custom.header = null;
            this.asset_custom.footer = null;
        }

    }
});

