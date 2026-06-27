Vue.component('option-form', {
    data() {
        return {
            route: 'options',
            id: null,
            name: languages(),
            values: [
                {
                    label: languages(),
                    price: null,
                    price_type: null,
                }
            ],
            type: '',
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
        }
    },
    props: {
        option: null,
    },
    mounted() {
        if (this.option) {
            this.id = this.option.id;
            this.name = this.option.name;
            this.type = this.option.type ? this.option.type : '';
            this.values = this.option.values.length > 0 ? this.option.values : [
                {
                    label: languages(),
                    price: null,
                    price_type: null
                }
            ];
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
                values: this.values,
                type: this.type,
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
            this.type = '';
            this.name = languages();
            this.values = [
                {
                    label: languages(),
                    price: null,
                    price_type: null
                }
            ];
            this.form.validation = null;
            this.form.disabledButton = false;
            this.form.loadingDisplay = false;
        },
        addRow() {
            this.values.push({
                label: languages(),
                price: null,
                price_type: null
            });
        },
        deleteRow(index) {
            if (index > 0) {
                Vue.delete(this.values, index);
            }
        }
    }
});
