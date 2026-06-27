Vue.component('admin-login-form', {
    data() {
        return {
            email: '',
            password: '',
            remember: false,
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            }
        }
    },
    methods: {
        login() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/auth', {
                email: this.email,
                password: this.password,
                remember: this.remember,
            }).then(response => {
                window.location.href = response.data.data.redirectTo;
            }).catch(error => {
                this.form.disabledButton = false;
                this.form.loadingDisplay = false;
                // Be defensive: backend might respond with HTML or non-standard JSON.
                const errors = error?.response?.data?.errors;
                if (errors) {
                    this.form.validation = errors;
                } else {
                    this.form.validation = {email: [error?.response?.data?.message || 'Login failed.']};
                }
            })
        }
    }
});

