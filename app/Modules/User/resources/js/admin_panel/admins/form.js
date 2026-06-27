import myUpload from 'vue-image-crop-upload/upload-2.vue';

Vue.component('admin-form', {
    data() {
        return {
            route: 'admins',
            id: null,
            personal_photo: null,
            first_name: '',
            last_name: '',
            password: '',
            password_confirmation: '',
            email: '',
            mobile: '',
            role: '',
            roles: [],
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
            show: false,
            headers: {
                'X-CSRF-TOKEN': TOKN,
            },
            imgDataUrl: userImageDefault() // the base64 url of created image
        }
    },
    components: {
        'my-upload': myUpload,
    },
    props: {
        admin: null,
    },
    mounted() {
        this.getRoles();

        if (this.admin) {
            this.id = this.admin.id;
            this.first_name = this.admin.first_name;
            this.last_name = this.admin.last_name;
            this.image = this.admin.image;
            this.email = this.admin.email;
            this.imgDataUrl = this.admin.image300;
            this.role = this.admin.role_id;
        }
    },
    methods: {
        save() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/store', {
                id: this.id,
                first_name: this.first_name,
                last_name: this.last_name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
                personal_photo: this.personal_photo,
                role: this.role,
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
        toggleShow(key = null) {
            this.show = !this.show;
        },
        cropSuccess(imgDataUrl, field) {
            console.log('-------- crop success --------');
            this.imgDataUrl = imgDataUrl;
        },
        cropUploadSuccess(jsonData, field) {
            console.log('-------- upload success --------');
            this.personal_photo = jsonData.location;
        },
        cropUploadFail(status, field) {
            console.log('-------- upload fail --------');
            swalError(status);
        },
        getRoles() {
            axios.get(ADMIN_URL + '/roles/all',).then(response => {
                this.roles = response.data.data;
            }).catch(error => {
                swalError(error);
            })
        },
        reset() {
            this.form.disabledButton = false;
            this.form.loadingDisplay = false;
            this.form.validation = null;
            this.id = null;
            this.full_name = '';
            this.role = '';
        }
    }
});

