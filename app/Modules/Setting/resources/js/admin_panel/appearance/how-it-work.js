Vue.component('appearance-how-it-work', {
    data() {
        return {
            route: 'settings',
            video_how_it_works: null,
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
    created() {
        //testimonial
    },
    mounted() {
        if (this.settings) {
            this.settings.forEach((obj, index) => {
                if (obj.key === 'video_how_it_works') {
                    this.video_how_it_works = obj.value
                }
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
                page: this.page,
                video_how_it_works: this.video_how_it_works,
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
            this.video_how_it_works = null;
        }
    }
});

