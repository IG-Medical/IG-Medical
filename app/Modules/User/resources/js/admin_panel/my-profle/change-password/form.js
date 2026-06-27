Vue.component('change-password-form', {
    data() {
        return {
            route: 'my-profile',
            current_password: '',
            new_password: '',
            new_password_confirm: '',
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            }
        }
    },
    methods: {
        save() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/change-password', {
                current_password: this.current_password,
                new_password: this.new_password,
                new_password_confirm: this.new_password_confirm,
            }).then(response => {
                this.reset();
                swalSuccess(response.data.message);
            }).catch(error => {
                this.form.disabledButton = false;
                this.form.loadingDisplay = false;
                this.form.validation = error.response.data.errors;
                swalError(error);
            })
        },
        reset() {
            this.form.disabledButton = false;
            this.form.loadingDisplay = false;
            this.form.validation = null;
            this.id = null;
            this.current_password = '';
            this.new_password = '';
            this.new_password_confirm = '';
        }
    }
});
