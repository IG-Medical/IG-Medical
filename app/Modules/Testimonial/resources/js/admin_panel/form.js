import myUpload from 'vue-image-crop-upload/upload-2.vue';

Vue.component('testimonial-form', {
    data() {
        return {
            route: 'testimonials',
            id: null,
            full_name: '',
            job_title: '',
            testimonial_text: '',
            image: null,
            image_url: null,
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
    components: {
        myUpload
    },
    props: {
        testimonial: null,
    },
    mounted() {
        if (this.testimonial) {
            this.id = this.testimonial.id;
            this.full_name = this.testimonial.full_name;
            this.job_title = this.testimonial.job_title;
            this.image = this.testimonial.image;
            this.image_url = this.testimonial.image_url;
            this.imgDataUrl = this.testimonial.image_url;
            this.testimonial_text = this.testimonial.testimonial_text;
        }
    },
    methods: {
        save() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/store', {
                id: this.id,
                full_name: this.full_name,
                job_title: this.job_title,
                testimonial_text: this.testimonial_text,
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
            this.full_name = '';
            this.job_title = '';
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
