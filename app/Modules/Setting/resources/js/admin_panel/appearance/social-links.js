Vue.component('appearance-social-links', {
    data() {
        return {
            route: 'settings',
            social_links: {
                facebook: '',
                twitter: '',
                youtube: '',
                instagram: '',
                linkedin: '',
            },
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
                this.social_links[obj.key] = obj.value;
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
                facebook: this.social_links.facebook,
                twitter: this.social_links.twitter,
                youtube: this.social_links.youtube,
                instagram: this.social_links.instagram,
                linkedin: this.social_links.linkedin,
                page: this.page,
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
            this.social_links = {
                facebook: '',
                twitter: '',
                youtube: '',
                instagram: '',
                linkedin: '',
            };
        }
    }
});

