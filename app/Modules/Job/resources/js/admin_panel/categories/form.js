Vue.component('category-form', {
    data() {
        return {
            id: null,
            title: languages(),
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            }
        }
    },
    props: {
        category: null,
    },
    mounted() {
        if (this.category) {
            this.id = this.category.id;
            this.title = this.category.title;
        }
    },
    methods: {
        save() {
            showLoading();
            this.form.disabledButton = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/jobs/categories/store', {
                id: this.id,
                title: this.title,
            }).then(response => {
                this.reset();
                swalSuccess(response.data.message);
                adminRedirectTo('jobs/categories');
            }).catch(error => {
                hideLoading();
                this.form.disabledButton = false;
                this.form.validation = error.response.data.errors;
                swalError(error);
            });
        },
        reset() {
            this.id = null;
            this.title = null;
            this.form.validation = null;
            this.form.disabledButton = false;
        },
    }
});
