Vue.component('appearance-contact-info', {
    data() {
        return {
            route: 'settings',
            contact_info: {
                email: '',
                phone: '',
                global_website: '',
                latitude:null,
                longitude:null,
                google_map: null,
            },
            address: languages(),
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
        }
    },
    props: {
        settings: null,
        page: null,
    },
    mounted() {
        if (this.settings) {
            this.settings.forEach((obj, index) => {
                if (obj.key === 'address')
                    this.address = obj.value;

                this.contact_info[obj.key] = obj.value;
            });
        }
    },
    methods: {
        save() {
            showLoading();
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/store', {
                email: this.contact_info.email,
                phone: this.contact_info.phone,
                global_website: this.contact_info.global_website,
                address: this.address,
                latitude: this.contact_info.latitude,
                longitude: this.contact_info.longitude,
                page: this.page,
                google_map: this.contact_info.google_map,
            }).then(response => {
                this.form.disabledButton = false;
                this.form.loadingDisplay = false;
                swalSuccess(response.data.message);
            }).catch(error => {
                this.form.disabledButton = false;
                this.form.loadingDisplay = false;
                this.form.validation = error.response.data.errors;
                swalError(error);
            })
        },
        reset() {
            this.contact_info = {
                email: '',
                phone: '',
                google_map: null,
                latitude:null,
                longitude:null,
            };
        }
    }
});

