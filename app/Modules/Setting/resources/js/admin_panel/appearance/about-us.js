Vue.component('appearance-about-us-form', {
    data() {
        return {
            route: 'settings',
            aboutUs: {
                section1: {
                    title: languages(),
                    content: languages(),
                },
                section2: {
                    title: languages(),
                    sub_title: languages(),
                    feather: [
                        {
                            title: languages(),
                            content: languages(),
                            image: languages(),
                            image_url: languages(),
                        },
                        {
                            title: languages(),
                            content: languages(),
                            image: languages(),
                            image_url: languages(),
                        },
                        {
                            title: languages(),
                            content: languages(),
                            image: languages(),
                            image_url: languages(),
                        },
                    ],
                },
                section3: [
                    {
                        title: languages(),
                        link_name: languages(),
                        url: '',
                        content: languages(),
                    }
                ],
            },
            options: {
                toolbar1: 'formatselect | fontselect | fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | help ',
                language_url: null,
                height: 500,
                images_upload_url: ROOT_URL + '/uploads/editor',
                directionality: LANG === 'ar' ? 'rtl' : 'ltr',  //ltr,rtl
            },
            options2: {
                menubar: false,
                //toolbar1: ' undo redo | styleselect | bold italic underline | forecolor ',
                language_url: null,
                height: 100,
                directionality: LANG === 'ar' ? 'rtl' : 'ltr',  //ltr,rtl
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
                if (obj.key === 'about_us_page') {
                    // $.each(this.banner.image_url, (index, value) => {
                    //                 this.image_url[index] = value;
                    //             });

                    if (obj.value) {

                        if (obj.value.section1)
                            this.aboutUs.section1 = obj.value.section1

                        if (obj.value.section2) {
                            this.aboutUs.section2 = obj.value.section2
                        }
                        if (obj.value.section3) {
                            this.aboutUs.section3 = obj.value.section3
                        }
                    }

                    //
                    // this.aboutUs.section3 = obj.value.section3
                }
            });

        }
    },
    methods: {
        addRowSection3Box() {
            this.aboutUs.section3.push({
                title: languages(),
                link_name: languages(),
                url: '',
                content: languages(),
            });
        },
        deleteRowSection3Box(index) {
            this.index = index;
            Vue.delete(this.aboutUs.section3, index);
        },
        save() {
            showLoading();
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/store', {
                page: this.page,
                about_us_page: this.aboutUs,
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
            this.footer_about_site = languages();
        }
    }
});

