Vue.component('role-form', {
    data() {
        return {
            route: 'roles',
            id: null,
            name: '',
            allPermissions: [],
            checkedPermissions: [],
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            }
        }
    },
    props: {
        role: null
    },
    mounted() {
        this.getAllPermissions();
        if (this.role) {
            this.id = this.role.id;
            this.name = this.role.name;

            _.forEach(this.role.permissions, (query) => {
                this.checkedPermissions.push(query.id);
            });
        }
    },
    methods: {
        getAllPermissions() {
            axios.get(ADMIN_URL + '/permissions/all').then(response => {
                this.allPermissions = _.groupBy(response.data.data, "group_name");
            });
        },
        save() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/store', {
                id: this.id,
                name: this.name,
                permissions: this.checkedPermissions,
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
            this.form.disabledButton = false;
            this.form.loadingDisplay = false;
            this.form.validation = null;
            this.id = null;
            this.name = '';
            this.permissions = [];
        }
    }
});

