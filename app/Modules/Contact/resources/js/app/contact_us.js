import VueRecaptcha from "vue-recaptcha";

Vue.component('contact-us-index', {
    data() {
        return {
            route: 'contact-us',
            full_name: '',
            subject: '',
            company_name: '',
            message: '',
            email: '',
            recaptcha: null,
            country: null,
            phone: null,
            favorite_product: null,
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            }
        }
    },
    components: {
        VueRecaptcha,
    },
    methods: {
        refreshRecaptcha() {
            this.$refs.recaptcha.reset();
        },
        onVerify(response) {
            this.recaptcha = response;
        },
        sendMessage() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(BASE_URL + '/' + this.route + '/store', {
                full_name: this.full_name,
                subject: this.subject,
                message: this.message,
                email: this.email,
                recaptcha: this.recaptcha,
                company_name: this.company_name,
                favorite_product: this.favorite_product,
                country: this.country,
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
            this.form.disabledButton = false;
            this.form.loadingDisplay = false;
            this.form.validation = null;
            this.full_name = null;
            this.favorite_product = null;
            this.subject = null;
            this.country = null;
            this.company_name = null;
            this.phone = null;
            this.message = null;
            this.email = null;
            this.$refs.recaptcha.reset();
        }
    }
});

