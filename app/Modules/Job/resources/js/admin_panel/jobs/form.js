Vue.component('job-form', {
    data() {
        return {
            categories: [],
            id: null,
            job_title: languages(),
            description: languages(),
            location: languages(),
            experience: languages(),
            status: languages(),
            phone: null,
            email: null,
            deadline: null,
            gender: null,
            category_id: null,
            isLoading: false,
            options: {
                toolbar1: 'formatselect | fontselect | fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | help ',
                height: 500,
                images_upload_url: ROOT_URL + '/uploads/editor',
                directionality: LANG === 'ar' ? 'rtl' : 'ltr',  //ltr,rtl
                menubar: false,
                language_url: null,
               // toolbar1: ' bold italic  | numlist bullist'
            },
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            }
        }
    },
    props: {
        job: null,
    },
    watch: {
    },
    mounted() {
        this.getCategories();
        console.log(this.job)
        if (this.job) {
            this.id = this.job.id;
            this.job_title = this.job.job_title;
            this.deadline = this.job.deadline;
            this.description = this.job.description;
            this.location = this.job.location;
            this.experience = this.job.experience;
            this.status = this.job.status;
            this.phone = this.job.phone;
            this.email = this.job.email;
            this.category_id = this.job.category_id;
            this.gender = this.job.gender;
        }
    },
    methods: {
        getCategories() {
            axios.get(ADMIN_URL + '/jobs/categories/all', {
                params: {}
            }).then(response => {
                this.categories = response.data.data;
            }).catch(error => {
            });
        },
        save() {
            showLoading();
            this.form.disabledButton = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/jobs/store', {
                id: this.id,
                user: this.user_id,
                job_title: this.job_title,
                description: this.description,
                gender: this.gender,
                location: this.location,
                experience: this.experience,
                status: this.status,
                phone: this.phone,
                email: this.email,
                deadline: this.deadline,
                category_id: this.category_id,
            }).then(response => {
                this.reset();
                swalSuccess(response.data.message);
                adminRedirectTo('jobs');
            }).catch(error => {
                hideLoading();
                this.form.disabledButton = false;
                this.form.validation = error.response.data.errors;
                swalError(error);
            });
        },
        reset() {
            this.form.validation = null;
            this.form.disabledButton = false;
        },
    }
});
