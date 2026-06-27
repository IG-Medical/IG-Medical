Vue.component('appearance-jobs-selection', {
    data() {
        return {
            route: 'jobs-selection',
            jobs: [],
            current_jobs: [],
            highlighted_jobs: [],
            something_jobs: [],
            isLoading: false,
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
        }
    },
    props: {
        pJobs: null,
        page: null,
    },
    created() {
    },
    mounted() {
        if (this.pJobs) {
            $.each(this.pJobs, (key, job) => {
                if (job.type == CURRENT_JOBS) {
                    this.current_jobs.push(job);
                }
                if (job.type == HIGHLIGHTED_JOBS) {
                    this.highlighted_jobs.push(job);
                }
                if (job.type == SOMETHING_JOB) {
                    this.something_jobs.push(job);
                }
            });
        }
    },
    methods: {
        getJobs(query) {
            this.isLoading = true;
            if (query.length > 0) {
                this.queryData = JSON.parse(JSON.stringify(query));
                axios.get(BASE_URL + '/jobs/end-point/search?q=' + escape(query))
                    .then((response) => {
                        this.isLoading = false;
                        this.jobs = response.data;
                    })
                    .catch((error) => {
                        this.isLoading = false;
                        swalError(error);
                    });
            } else
                this.isLoading = false;
        },
        save() {
            showLoading();
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/store', {
                page: this.page,
                current_jobs: this.current_jobs,
                highlighted_jobs: this.highlighted_jobs,
                something_jobs: this.something_jobs,
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
        }
    }
});

