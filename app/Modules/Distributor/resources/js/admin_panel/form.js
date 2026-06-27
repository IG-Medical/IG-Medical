import myUpload from 'vue-image-crop-upload/upload-2.vue';

Vue.component('distributor-form', {
    data() {
        return {
            route: 'distributors',
            id: null,
            LocationLat: -34,
            LocationLng: 151,
            title: languages(),
            description: languages(),
            image: null,
            image_url: null,
            country: null,
            show_map: true,
            options: {
                toolbar1: 'formatselect | fontselect | fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | help ',
                language_url: null,
                height: 500,
                images_upload_url: ROOT_URL + '/uploads/editor',
                directionality: LANG === 'ar' ? 'rtl' : 'ltr',  //ltr,rtl
            },
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
            headers: {
                'X-CSRF-TOKEN': TOKN,
            },
            show: false,
            imgDataUrl: userImageDefault()
        }
    },
    components:{
        myUpload
    },
    props: {
        distributor: null,
    },
    mounted() {
        if (this.distributor) {
            this.id = this.distributor.id;
            this.title = this.distributor.title;
            this.description = this.distributor.description;
            this.image = this.distributor.image;
            this.image_url = this.distributor.image_url;
            this.imgDataUrl = this.distributor.image_url;
            this.LocationLat = parseFloat(this.distributor.lat);
            this.LocationLng = parseFloat(this.distributor.long);
            this.show_map = this.distributor.show_map;
            this.country = this.distributor.country_id;
        }
    },
    methods: {
        save() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/store', {
                id: this.id,
                title: this.title,
                description: this.description,
                lat: this.LocationLat,
                long: this.LocationLng,
                show_map: this.show_map,
                country: this.country,
                image: this.handlerImage(),
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
        handlerImage() {
            if (this.image) {
                this.image = this.image['file_link'] ? this.image['file_link'] : this.image;

                return this.image;
            }
            return null;
        },
        reset() {
            this.id = null;
            this.country_id = null;
            this.show_map = true;
            this.LocationLat = -34;
            this.LocationLng = 151;
            this.title = languages();
            this.description = languages();
            this.image = null;
            this.image_url = null;
            this.form.validation = null;
            this.form.disabledButton = false;
            this.form.loadingDisplay = false;
        },
        toggleShow(key = null) {
            this.show = !this.show;
        },
        cropSuccess(imgDataUrl, field) {
            console.log('-------- crop success --------');
            this.imgDataUrl = imgDataUrl;
        },
        cropUploadSuccess(jsonData, field) {
            console.log('-------- upload success --------');
            this.image = jsonData.location;
        },
        cropUploadFail(status, field) {
            console.log('-------- upload fail --------');
            swalError(status);
        },

    }
});
