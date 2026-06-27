Vue.component('attribute-set-form', {
    data() {
        return {
            route: 'attribute-sets',
            id: null,
            name: languages(),
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
        }
    },
    props: {
        attribute: null,
    },
    mounted() {
        if (this.attribute) {
            this.id = this.attribute.id;
            this.name = this.attribute.name;
        }
    },
    methods: {
        save() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/store', {
                id: this.id,
                name: this.name,
            }).then(response => {
                this.reset();
                swalSuccess(response.data.message);
                adminRedirectTo(this.route);
            }).catch(error => {
                this.form.disabledButton = false;
                this.form.loadingDisplay = false;
                this.form.validation = error.response.data.errors;
                swalError(error);
            })
        },

        reset() {
            this.id = null;
            this.name = languages();
            this.form.validation = null;
            this.form.disabledButton = false;
            this.form.loadingDisplay = false;
        },
    }
});
