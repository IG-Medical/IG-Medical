Vue.component('admin-restore-password-form', {
    data() {
        return {
            new_password: '',
            confirm_new_password: '',
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            }
        }
    },
    props: {
        token: null,
    },
    methods: {
        restorePassword() {
            this.onButton();
            this.resetMessages();
            axios.post(ADMIN_URL + '/password/reset', {
                token: this.token,
                isAdmin: true,
                password: this.new_password,
                password_confirmation: this.confirm_new_password,
            }).then(response => {
                this.resetButton();
                this.form.success_message = response.data.message;
                redirectTo(response.data.data.redirectTo)
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
        },
        cancel() {
            this.forgot_email = null;
            this.resetButton();
            this.resetMessages();
        }
    }
});

