Vue.component('attribute-form', {
    data() {
        return {
            route: 'attributes',
            id: null,
            name: languages(),
            values: [],
            attribute_values: [
                {
                    name: languages(),
                }
            ],
            attribute_set: '',
            attributes_sets: [],
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
        this.getAttributesSets();

        if (this.attribute) {
            this.id = this.attribute.id;
            this.name = this.attribute.name;
            this.attribute_set = this.attribute.attribute_set_id ? this.attribute.attribute_set_id : '';
            this.attribute_values = this.attribute.values.length > 0 ? this.attribute.values : [{name: languages()}];
        }
    },
    methods: {
        getAttributesSets() {
            axios.get(ADMIN_URL + '/attribute-sets/all', {}).then(response => {
                this.attributes_sets = response.data.data;
            }).catch(error => {
            });
        },
        save() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/store', {
                id: this.id,
                name: this.name,
                values: this.attribute_values,
                attribute_set: this.attribute_set,
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
            this.attribute_set = '';
            this.name = languages();
            this.attribute_values = [
                {
                    name: languages(),
                }
            ];
            this.values = [];
            this.form.validation = null;
            this.form.disabledButton = false;
            this.form.loadingDisplay = false;
        },
        addRow() {
            this.attribute_values.push({
                name: languages(),
            });
        },
        deleteRow(index) {
            if (index > 0) {
                Vue.delete(this.attribute_values, index);
            } else {
                //this.form.message = this.$t('val3');
            }
        }
    }
});
