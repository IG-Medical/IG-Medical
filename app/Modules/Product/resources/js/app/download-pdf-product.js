Vue.component('download-pdf-product', {
    data() {
        return {
            route: 'download-pdf-product',
            first_name: '',
            surname: '',
            department: '',
            i_agree: '',
            company: '',
            country_id: '',
            email: '',
            phone: '',
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            }
        }
    },
    props: {
        product:null,
    },
    components: {
    },
    methods: {
        download() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(BASE_URL + '/' + this.route + '/store', {
                first_name: this.first_name,
                surname: this.surname,
                department: this.department,
                i_agree: this.i_agree,
                company: this.company,
                email: this.email,
                product_id: this.product.id,
                country_id: this.country_id,
                phone: this.phone,
            }).then(response => {
                this.reset();
                toastSuccess(response.data.message);
            }).catch(error => {
                this.form.disabledButton = false;
                this.form.loadingDisplay = false;
                this.form.validation = error.response.data.errors;
            })
        },
        reset() {
            $('#modalDownload').modal('hide');
            this.form.disabledButton = false;
            this.form.loadingDisplay = false;
            this.form.validation = null;
            this.first_name = null;
            this.phone = null;
            this.surname = null;
            this.department = null;
            this.email = null;
            this.country_id = null;
            this.i_agree = null;
            this.company = null;
        }
    }
});

