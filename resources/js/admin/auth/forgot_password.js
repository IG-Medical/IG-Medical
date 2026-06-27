Vue.component('admin-forgot-password-form', {
    data() {
        return {
            email: '',
            form: {
                validation: null,
                success_message: null,
                disabledButton: false,
                loadingDisplay: false,
            }
        }
    },
    methods: {
        forgotEmail() {
            this.onButton();
            this.resetMessages();
            axios.post(ADMIN_URL + '/password/email', {
                email: this.email,
            }).then(response => {
                this.resetButton();
                this.form.success_message = response.data.message;
            }).catch(error => {
                this.resetButton();
                this.form.validation = error.response.data.errors;
            })
        },
        resetButton() {
            this.form.disabledButton = false;
            this.form.loadingDisplay = false;
        },
        onButton() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
        },
        resetMessages() {
            this.form.validation = null;
            this.form.success_message = null;
        },
        cancel() {
            this.email = null;
            this.resetButton();
            this.resetMessages();
        }
    }
});

