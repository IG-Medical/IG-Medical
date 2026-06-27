Vue.component('setting-general-index', {
    data() {
        return {
            route: 'settings',
            product_pdf: 1,
            google_map_api_key: null,
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
                if (obj.key === 'product_pdf') {
                    this.product_pdf = obj.value
                }
                if (obj.key === 'google_map_api_key') {
                    this.google_map_api_key = obj.value
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
                product_pdf: this.product_pdf,
                google_map_api_key: this.google_map_api_key,
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
            this.product_pdf = null;
            this.google_map_api_key = null;
        }
    }
});

