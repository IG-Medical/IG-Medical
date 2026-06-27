import myUpload from 'vue-image-crop-upload/upload-2.vue';

Vue.component('appearance-breadcrumbs-form', {
    data() {
        return {
            route: 'settings',
            breadcrumb_contact_us: null,
            breadcrumb_contact_us_url: null,

            breadcrumb_ig_world: null,
            breadcrumb_ig_world_url: null,

            breadcrumb_job: null,
            breadcrumb_job_url: null,

            breadcrumb_news: null,
            breadcrumb_news_url: null,

            breadcrumb_public_page: null,
            breadcrumb_public_page_url: null,

            breadcrumb_certifications: null,
            breadcrumb_certifications_url: null,

            breadcrumb_about_us: null,
            breadcrumb_about_us_url: null,

            breadcrumb_sales: null,
            breadcrumb_sales_url: null,

            breadcrumb_technical: null,
            breadcrumb_technical_url: null,

            breadcrumb_customized : null,
            breadcrumb_customized_url: null,

            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
            headers: {
                'X-CSRF-TOKEN': TOKN,
            },
            showBreadcrumbImageContactUs: false,
            imgContactUsBreadcrumbImageDataUrl: userImageDefault(),

            showBreadcrumbImageIGWorld: false,
            imgIGWorldBreadcrumbImageDataUrl: userImageDefault(),

            showBreadcrumbImageJob: false,
            imgJobBreadcrumbImageDataUrl: userImageDefault(),

            showBreadcrumbImageNews: false,
            imgNewsBreadcrumbImageDataUrl: userImageDefault(),

            showBreadcrumbImagePublicPage: false,
            imgPublicPageBreadcrumbImageDataUrl: userImageDefault(),

            showBreadcrumbImageCertifications: false,
            imgCertificationsBreadcrumbImageDataUrl: userImageDefault(),

            showBreadcrumbImageAboutUs: false,
            imgAboutUsBreadcrumbImageDataUrl: userImageDefault(),


            showBreadcrumbImageSales: false,
            imgSalesBreadcrumbImageDataUrl: userImageDefault(),

            showBreadcrumbImageTechnical: false,
            imgTechnicalBreadcrumbImageDataUrl: userImageDefault(),


            showBreadcrumbImageCustomized: false,
            imgCustomizedBreadcrumbImageDataUrl: userImageDefault(),


        }
    },
    components: {
        myUpload
    },
    props: {
        settings: null,
        page: null,
    },
    mounted() {
        if (this.settings) {
            this.settings.forEach((obj, index) => {
                if (obj.key === 'breadcrumb_customized') {
                    this.breadcrumb_customized = obj.value['file']
                    this.imgCustomizedBreadcrumbImageDataUrl = obj.value['url']
                }

                if (obj.key === 'breadcrumb_sales') {
                    this.breadcrumb_sales = obj.value['file']
                    this.imgSalesBreadcrumbImageDataUrl = obj.value['url']
                }
                if (obj.key === 'breadcrumb_technical') {
                    this.breadcrumb_technical = obj.value['file']
                    this.imgTechnicalBreadcrumbImageDataUrl = obj.value['url']
                }
                if (obj.key === 'breadcrumb_contact_us') {
                    this.breadcrumb_contact_us = obj.value['file']
                    this.imgContactUsBreadcrumbImageDataUrl = obj.value['url']
                }
                if (obj.key === 'breadcrumb_ig_world') {
                    if (obj.value) {
                        this.breadcrumb_ig_world = obj.value['file']
                        this.breadcrumb_ig_world_url = obj.value['url']
                        this.imgIGWorldBreadcrumbImageDataUrl = obj.value['url']
                    }
                }
                if (obj.key === 'breadcrumb_job') {
                    if (obj.value) {
                        this.breadcrumb_job = obj.value['file']
                        this.breadcrumb_job_url = obj.value['url']
                        this.imgJobBreadcrumbImageDataUrl = obj.value['url']
                    }
                }
                if (obj.key === 'breadcrumb_news') {
                    if (obj.value) {
                        this.breadcrumb_news = obj.value['file']
                        this.breadcrumb_news_url = obj.value['url']
                        this.imgNewsBreadcrumbImageDataUrl = obj.value['url']
                    }
                }
                if (obj.key === 'breadcrumb_public_page') {
                    if (obj.value) {
                        this.breadcrumb_public_page = obj.value['file']
                        this.breadcrumb_public_page_url = obj.value['url']
                        this.imgPublicPageBreadcrumbImageDataUrl = obj.value['url']
                    }
                }
                if (obj.key === 'breadcrumb_certifications') {
                    if (obj.value) {
                        this.breadcrumb_certifications = obj.value['file']
                        this.breadcrumb_certifications_url = obj.value['url']
                        this.imgCertificationsBreadcrumbImageDataUrl = obj.value['url']
                    }
                }
                if (obj.key === 'breadcrumb_about_us') {
                    if (obj.value) {
                        this.breadcrumb_about_us = obj.value['file']
                        this.breadcrumb_about_us_url = obj.value['url']
                        this.imgAboutUsBreadcrumbImageDataUrl = obj.value['url']
                    }
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
                breadcrumb_sales: this.handlerImage(this.breadcrumb_sales),
                breadcrumb_technical: this.handlerImage(this.breadcrumb_technical),
                breadcrumb_contact_us: this.handlerImage(this.breadcrumb_contact_us),
                breadcrumb_ig_world: this.handlerImage(this.breadcrumb_ig_world),
                breadcrumb_job: this.handlerImage(this.breadcrumb_job),
                breadcrumb_news: this.handlerImage(this.breadcrumb_news),
                breadcrumb_public_page: this.handlerImage(this.breadcrumb_public_page),
                breadcrumb_certifications: this.handlerImage(this.breadcrumb_certifications),
                breadcrumb_about_us: this.handlerImage(this.breadcrumb_about_us),
                breadcrumb_customized: this.handlerImage(this.breadcrumb_customized),
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
        handlerImage(img) {
            if (img) {
                img = img['file_link'] ? img['file_link'] : img;

                return img;
            }
            return null;
        },
        reset() {

        },
        toggleShowBreadcrumbImageCustomized(lang = null) {
            this.showBreadcrumbImageCustomized = !this.showBreadcrumbImageContactUs;
        },
        cropSuccessBreadcrumbImageCustomized(imgDataUrl, field) {
            this.imgCustomizedBreadcrumbImageDataUrl = imgDataUrl;
        },
        cropUploadSuccessBreadcrumbImageCustomized(jsonData, field) {
            this.breadcrumb_customized = jsonData.location;
        },
        cropUploadFailBreadcrumbImageCustomized(status, field) {
            swalError(status);
        },

        toggleShowBreadcrumbImageContactUs(lang = null) {
            this.showBreadcrumbImageContactUs = !this.showBreadcrumbImageContactUs;
        },
        cropSuccessBreadcrumbImageContactUs(imgDataUrl, field) {
            this.imgContactUsBreadcrumbImageDataUrl = imgDataUrl;
        },
        cropUploadSuccessBreadcrumbImageContactUs(jsonData, field) {
            this.breadcrumb_contact_us = jsonData.location;
            console.log(this.breadcrumb_contact_us)
        },
        cropUploadFailBreadcrumbImageContactUs(status, field) {
            swalError(status);
        },

        toggleShowBreadcrumbImageIGWorld(lang = null) {
            this.showBreadcrumbImageIGWorld = !this.showBreadcrumbImageIGWorld;
        },
        cropSuccessBreadcrumbImageIGWorld(imgDataUrl, field) {
            this.imgIGWorldBreadcrumbImageDataUrl = imgDataUrl;
        },
        cropUploadSuccessBreadcrumbImageIGWorld(jsonData, field) {
            this.breadcrumb_ig_world = jsonData.location;
        },
        cropUploadFailBreadcrumbImageIGWorld(status, field) {
            swalError(status);
        },


        toggleShowBreadcrumbImageJob(lang = null) {
            this.showBreadcrumbImageJob = !this.showBreadcrumbImageJob;
        },
        cropSuccessBreadcrumbImageJob(imgDataUrl, field) {
            this.imgJobBreadcrumbImageDataUrl = imgDataUrl;
        },
        cropUploadSuccessBreadcrumbImageJob(jsonData, field) {
            this.breadcrumb_job = jsonData.location;
        },
        cropUploadFailBreadcrumbImageJob(status, field) {
            swalError(status);
        },


        toggleShowBreadcrumbImageNews(lang = null) {
            this.showBreadcrumbImageNews = !this.showBreadcrumbImageNews;
        },
        cropSuccessBreadcrumbImageNews(imgDataUrl, field) {
            this.imgNewsBreadcrumbImageDataUrl = imgDataUrl;
        },
        cropUploadSuccessBreadcrumbImageNews(jsonData, field) {
            this.breadcrumb_news = jsonData.location;
        },
        cropUploadFailBreadcrumbImageNews(status, field) {
            swalError(status);
        },


        toggleShowBreadcrumbImagePublicPage(lang = null) {
            this.showBreadcrumbImagePublicPage = !this.showBreadcrumbImagePublicPage;
        },
        cropSuccessBreadcrumbImagePublicPage(imgDataUrl, field) {
            this.imgPublicPageBreadcrumbImageDataUrl = imgDataUrl;
        },
        cropUploadSuccessBreadcrumbImagePublicPage(jsonData, field) {
            this.breadcrumb_public_page = jsonData.location;
        },
        cropUploadFailBreadcrumbImagePublicPage(status, field) {
            swalError(status);
        },


        toggleShowBreadcrumbImageCertifications(lang = null) {
            this.showBreadcrumbImageCertifications = !this.showBreadcrumbImageCertifications;
        },
        cropSuccessBreadcrumbImageCertifications(imgDataUrl, field) {
            this.imgCertificationsBreadcrumbImageDataUrl = imgDataUrl;
        },
        cropUploadSuccessBreadcrumbImageCertifications(jsonData, field) {
            this.breadcrumb_certifications = jsonData.location;
        },
        cropUploadFailBreadcrumbImageCertifications(status, field) {
            swalError(status);
        },


        toggleShowBreadcrumbImageAboutUs(lang = null) {
            this.showBreadcrumbImageAboutUs = !this.showBreadcrumbImageAboutUs;
        },
        cropSuccessBreadcrumbImageAboutUs(imgDataUrl, field) {
            this.imgAboutUsBreadcrumbImageDataUrl = imgDataUrl;
        },
        cropUploadSuccessBreadcrumbImageAboutUs(jsonData, field) {
            this.breadcrumb_about_us = jsonData.location;
        },
        cropUploadFailBreadcrumbImageAboutUs(status, field) {
            swalError(status);
        },


        toggleShowBreadcrumbImageTechnical(lang = null) {
            this.showBreadcrumbImageTechnical = !this.showBreadcrumbImageTechnical;
        },
        cropSuccessBreadcrumbImageTechnical(imgDataUrl, field) {
            this.imgTechnicalBreadcrumbImageDataUrl = imgDataUrl;
        },
        cropUploadSuccessBreadcrumbImageTechnical(jsonData, field) {
            this.breadcrumb_technical = jsonData.location;
        },
        cropUploadFailBreadcrumbImageTechnical(status, field) {
            swalError(status);
        },

        toggleShowBreadcrumbImageSales(lang = null) {
            this.showBreadcrumbImageSales = !this.showBreadcrumbImageSales;
        },
        cropSuccessBreadcrumbImageSales(imgDataUrl, field) {
            this.imgSalesBreadcrumbImageDataUrl = imgDataUrl;
        },
        cropUploadSuccessBreadcrumbImageSales(jsonData, field) {
            this.breadcrumb_sales = jsonData.location;
        },
        cropUploadFailBreadcrumbImageSales(status, field) {
            swalError(status);
        },

    }
});

