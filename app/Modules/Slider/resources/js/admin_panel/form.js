import myUpload from 'vue-image-crop-upload/upload-2.vue';

Vue.component('slider-form', {
    data() {
        return {
            route: 'sliders',
            id: null,
            background_image: languages(),
            background_image_url: languages(),
            caption_1: languages(),
            caption_2: languages(),
            caption_3: languages(),
            home_page_center: false,
            home_page_top: false,
            call_to_action_text_1: languages(),
            call_to_action_text_2: languages(),
            call_to_action_url_1: null,
            call_to_action_url_2: null,
            call_to_action_url_3: null,
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
            headers: {
                'X-CSRF-TOKEN': TOKN,
            },
            imageLang:LANG,
            show: languages(),
            imgDataUrl: userImageDefault(true)
        }
    },
    components: {
        myUpload
    },
    props: {
        slider: null
    },
    mounted() {
        if (this.slider) {
            this.id = this.slider.id;
            this.background_image = this.slider.background;
            $.each(this.slider.background_url, (index, value) => {
                this.background_image_url[index] = value;
                this.imgDataUrl[index] = value;
            });
            this.caption_1 = this.slider.caption_1;
            this.caption_2 = this.slider.caption_2;
            this.caption_3 = this.slider.caption_3;
            this.call_to_action_text_1 = this.slider.call_to_action_text_1;
            this.call_to_action_text_2 = this.slider.call_to_action_text_2;
            this.call_to_action_url_1 = this.slider.call_to_action_url_1;
            this.call_to_action_url_1 = this.slider.call_to_action_url_1;
            this.call_to_action_url_2 = this.slider.call_to_action_url_2;
            this.call_to_action_url_3 = this.slider.call_to_action_url_3;
            this.home_page_center = this.slider.home_page_center;
            this.home_page_top = this.slider.home_page_top;
        }
    },
    methods: {
        save() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/store', {
                id: this.id,
                caption_1: this.caption_1,
                caption_2: this.caption_2,
                caption_3: this.caption_3,
                call_to_action_text_1: this.call_to_action_text_1,
                call_to_action_text_2: this.call_to_action_text_2,
                call_to_action_url_1: this.call_to_action_url_1,
                call_to_action_url_2: this.call_to_action_url_2,
                call_to_action_url_3: this.call_to_action_url_3,
                home_page_center: this.home_page_center,
                home_page_top: this.home_page_top,
                background_image: this.handlerImage(),
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
            $.each(this.background_image, (index, value) => {
                if (this.background_image[index] && this.background_image[index]['file_link']) {
                    this.background_image[index] = this.background_image[index]['file_link'] ? this.background_image[index]['file_link'] : this.background_image[index];
                }
            });
            return this.background_image;
        },
        reset() {
            this.form.disabledButton = false;
            this.form.loadingDisplay = false;
            this.form.validation = null;
            this.id = null;

            this.caption_1 = languages();
            this.caption_2 = languages();
            this.caption_3 = languages();
            this.call_to_action_text_1 = languages();
            this.call_to_action_text_2 = languages();
            this.call_to_action_url_1 = null;
            this.call_to_action_url_2 = null;
            this.call_to_action_url_3 = null;
            this.home_page_center = false;
            this.home_page_top = false;
            this.background_image = languages();
            this.background_image_url = languages();
        },
        toggleShow(lang = null) {
            this.imageLang = lang;
            this.show[lang] = !this.show[lang];
        },
        cropSuccess(imgDataUrl, field) {
        },
        cropUploadSuccess(jsonData, field) {
            this.imgDataUrl[this.imageLang] = jsonData.file_url;
            this.background_image[this.imageLang] = jsonData.location;
        },
        cropUploadFail(status, field) {
            swalError(status);
        },

    }
});

