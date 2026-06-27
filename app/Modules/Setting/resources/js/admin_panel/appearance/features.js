Vue.component('appearance-features-form', {
    data() {
        return {
            route: 'settings',
            feature_1: {
                caption_1: languages(),
                caption_2: languages(),
                icon: null,
            },
            feature_2: {
                caption_1: languages(),
                caption_2: languages(),
                icon: null,
            },
            feature_3: {
                caption_1: languages(),
                caption_2: languages(),
                icon: null,
            },
            feature_4: {
                caption_1: languages(),
                caption_2: languages(),
                icon: null,
            },
            feature_5: {
                caption_1: languages(),
                caption_2: languages(),
                icon: null,
            },
            icon_1_url: null,
            icon_2_url: null,
            icon_3_url: null,
            icon_4_url: null,
            icon_5_url: null,
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
    watch: {
        // feature_1: {
        //     handler(val) {
        //         if (this.feature_1.icon)
        //             this.feature_1.icon = this.feature_1.icon['file_link'];
        //     },
        //     deep: true
        // },
    },
    mounted() {
        if (this.settings) {

            this.settings.forEach((obj, index) => {
                if (obj.key === 'feature_1') {
                    this.feature_1 = obj.value;
                    this.icon_1_url = obj.value.icon_url;
                }
                if (obj.key === 'feature_2') {
                    this.feature_2 = obj.value;
                    this.icon_2_url = obj.value.icon_url;
                }
                if (obj.key === 'feature_3') {
                    this.feature_3 = obj.value;
                    this.icon_3_url = obj.value.icon_url;
                }
                if (obj.key === 'feature_4') {
                    this.feature_4 = obj.value;
                    this.icon_4_url = obj.value.icon_url;
                }
                if (obj.key === 'feature_5') {
                    this.feature_5 = obj.value;
                    this.icon_5_url = obj.value.icon_url;
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
                feature_1: this.feature_1,
                feature_2: this.feature_2,
                feature_3: this.feature_3,
                feature_4: this.feature_4,
                feature_5: this.feature_5,
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
            this.feature_1 = {
                caption_1: languages(),
                caption_2: languages(),
                icon: null,
                icon_url: null,
            };
            this.feature_2 = {
                caption_1: languages(),
                caption_2: languages(),
                icon: null,
                icon_url: null,
            };
            this.feature_3 = {
                caption_1: languages(),
                caption_2: languages(),
                icon: null,
                icon_url: null,
            };
            this.feature_4 = {
                caption_1: languages(),
                caption_2: languages(),
                icon: null,
                icon_url: null,
            };
            this.feature_5 = {
                caption_1: languages(),
                caption_2: languages(),
                icon: null,
                icon_url: null,
            };
        }
    }
});

