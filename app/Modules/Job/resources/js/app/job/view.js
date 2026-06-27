Vue.component('job-view', {
    data() {
        return {
            route: 'jobs',
            showForm: false,
            application_details: null,
            isRefresh: false,
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
            salutation: '',
            first_name: '',
            last_name: '',
            email: '',
            email_confirmation: '',
            phone: '',
            street: '',
            plz: '',
            number: '',
            earliest_start_of_work: '',
            land: '',
            place_of_residence: '',
            salary_expectations: '',
            attentive_to_business_through: '',
            internal_application: false,
            data_protection: false,
            admission_to_talent_pool: false,
            file_write_to: null,
            file_total_package: null,
            file_miscellaneous: null,
            file_testimonials: null,
            file_curriculum: null,
        }
    },
    props: {
        careerId: null,
    },
    mounted() {
        $('#modalApplayApplicant').on('hide.bs.modal', (e) => {
            this.reset();
        });
    },
    watch: {},
    methods: {
        applayAppliction() {

            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(BASE_URL + '/applications/store', {
                career_id: this.careerId,
                salutation: this.salutation,
                first_name: this.first_name,
                last_name: this.last_name,
                email: this.email,
                email_confirmation: this.email_confirmation,
                phone: this.phone,
                street: this.street,
                plz: this.plz,
                number: this.number,
                earliest_start_of_work: this.earliest_start_of_work,
                land: this.land,
                place_of_residence: this.place_of_residence,
                salary_expectations: this.salary_expectations,
                internal_application: this.internal_application,
                data_protection: this.data_protection,
                admission_to_talent_pool: this.admission_to_talent_pool,
                attentive_to_business_through: this.attentive_to_business_through,
                file_write_to: this.file_write_to,
                file_total_package: this.file_total_package,
                file_miscellaneous: this.file_miscellaneous,
                file_testimonials: this.file_testimonials,
                file_curriculum: this.file_curriculum,
            }).then(response => {
                $('#modalApplayApplicant').modal('hide');
                this.reset();
                toastSuccess(response.data.message);
            }).catch(error => {
                this.form.disabledButton = false;
                this.form.loadingDisplay = false;
                this.form.validation = error.response.data.errors;
            })
        },
        reset() {
            this.salutation = '';
            this.first_name = '';
            this.last_name = '';
            this.email = '';
            this.email_confirmation = '';
            this.phone = '';
            this.street = '';
            this.plz = '';
            this.number = '';
            this.earliest_start_of_work = '';
            this.land = '';
            this.place_of_residence = '';
            this.salary_expectations = '';
            this.attentive_to_business_through = '';
            this.internal_application = '';
            this.data_protection = '';
            this.admission_to_talent_pool = '';
            this.file_write_to = '';
            this.file_total_package = '';
            this.file_miscellaneous = '';
            this.file_testimonials = '';
            this.file_curriculum = '';
            this.form.disabledButton = false;
            this.form.validation = null;
            $('#curriculum_vitae').val('');
        },
        increaseFontSize() {
            var size = parseInt($('.item-job .job-title-search').css('font-size'));
            var size_2 = parseInt($('.item-job .job-description-search').css('font-size'));
            size = size + 2;
            size_2 = size_2 + 2;
            if (size <= 20) {
                $(".item-job .job-title-search").css({'cssText': 'font-size:' + size + 'px !important'});
            }
            if (size_2 <= 18) {
                $(".item-job .job-description-search").css({'cssText': 'font-size:' + size_2 + 'px !important'});
            }
        },
        fontDecreaseSize() {
            var size = parseInt($('.item-job .job-title-search').css('font-size'));
            var size_2 = parseInt($('.item-job .job-description-search').css('font-size'));

            size = size - 2;
            size_2 = size_2 - 2;
            if (size >= 16) {
                $(".item-job .job-title-search").css({'cssText': 'font-size:' + size + 'px !important'});
            }
            if (size_2 >= 14) {
                $(".item-job .job-description-search").css({'cssText': 'font-size:' + size_2 + 'px !important'});
            }
        },
        viewApplication() {
            this.showForm = true;
        },
        listenerRefresh(event) {
            this.isRefresh = true;
        },
        rePostJob(id, title) {
            this.$confirm(this.$t('are_you_sure_to_repost_the_job', {name: title}), this.$t('repost_job'), {
                confirmButtonText: this.$t('Yes'),
                cancelButtonText: this.$t('No'),
                type: 'warning'
            }).then(() => {
                axios.put(BASE_URL + '/' + this.route + '/' + id + "/repost").then(response => {
                    toastSuccess(response.data.message);
                    location.reload();
                }).catch(error => {
                    toastError(error);
                });
            });
        },
        jobArchive(id, title) {
            this.$confirm(this.$t('Are_you_sure_to_Archive_the_job', {name: title}), this.$t('Archive_job'), {
                confirmButtonText: this.$t('Yes'),
                cancelButtonText: this.$t('No'),
                type: 'warning'
            }).then(() => {
                axios.put(BASE_URL + '/' + this.route + '/' + id + "/archive").then(response => {
                    toastSuccess(response.data.message);
                    location.reload();
                }).catch(error => {
                    toastError(error);
                });
            });
        },
        jobCancel(id, title) {
            this.$confirm(this.$t('Are_you_sure_to_cancel_the_job', {name: title}), this.$t('cancel_job'), {
                confirmButtonText: this.$t('Yes'),
                cancelButtonText: this.$t('No'),
                type: 'warning'
            }).then(() => {
                axios.put(BASE_URL + '/' + this.route + '/' + id + "/cancel").then(response => {
                    toastSuccess(response.data.message);
                    location.reload();
                }).catch(error => {
                    toastError(error);
                });
            });
        },
        deleteJob(id, title) {
            this.$confirm(this.$t('Are_you_sure_to_delete_the_job', {name: title}), this.$t('delete_job'), {
                confirmButtonText: this.$t('Yes'),
                cancelButtonText: this.$t('No'),
                type: 'warning'
            }).then(() => {
                axios.delete(BASE_URL + '/' + this.route + '/' + id + "/delete").then(response => {
                    toastSuccess(response.data.message);
                    redirectTo('/' + LANG + '/dashboard/jobs/my-list');
                }).catch(error => {
                    toastError(error);
                });
            });
        },

        uploadFileWriteTo(e) {
            var file = e.target.files[0];
            var file_name = file ? file.name : '';

            var extension = file_name.substr((file_name.lastIndexOf('.') + 1)).toLowerCase();
            var extensions = ["jpg", "jpeg", "png", "pdf", "doc", 'docx'];

            if (!extensions || extensions.indexOf(extension) < 0) {
                this.form.validation = {
                    write_to: ["Please upload extensions file  " + extensions.toString()]
                };
                return false;
            }
            var formData = new FormData();
            formData.append('file', file);
            formData.append('upload', 'applications');

            this.form.validation = null;

            axios.post(ROOT_URL + '/uploads/file', formData)
                .then(response => {
                    this.file_write_to = response.data.file_link;
                })
                .catch(function (err) {
                    this.form.validation = err.response.data.errors;
                });
        },
        uploadFileCurriculum(e) {
            var file = e.target.files[0];
            var file_name = file ? file.name : '';

            var extension = file_name.substr((file_name.lastIndexOf('.') + 1)).toLowerCase();
            var extensions = ["jpg", "jpeg", "png", "pdf", "doc", 'docx'];

            if (!extensions || extensions.indexOf(extension) < 0) {
                this.form.validation = {
                    write_to: ["Please upload extensions file  " + extensions.toString()]
                };
                return false;
            }
            var formData = new FormData();
            formData.append('file', file);
            formData.append('upload', 'applications');

            this.form.validation = null;

            axios.post(ROOT_URL + '/uploads/file', formData)
                .then(response => {
                    this.file_curriculum = response.data.file_link;
                })
                .catch(function (err) {
                    this.form.validation = err.response.data.errors;
                });
        },
        uploadFileTestimonials(e) {
            var file = e.target.files[0];
            var file_name = file ? file.name : '';

            var extension = file_name.substr((file_name.lastIndexOf('.') + 1)).toLowerCase();
            var extensions = ["jpg", "jpeg", "png", "pdf", "doc", 'docx'];

            if (!extensions || extensions.indexOf(extension) < 0) {
                this.form.validation = {
                    write_to: ["Please upload extensions file  " + extensions.toString()]
                };
                return false;
            }
            var formData = new FormData();
            formData.append('file', file);
            formData.append('upload', 'applications');

            this.form.validation = null;

            axios.post(ROOT_URL + '/uploads/file', formData)
                .then(response => {
                    this.file_testimonials = response.data.file_link;
                })
                .catch(function (err) {
                    this.form.validation = err.response.data.errors;
                });
        },
        uploadFileMiscellaneous(e) {
            var file = e.target.files[0];
            var file_name = file ? file.name : '';

            var extension = file_name.substr((file_name.lastIndexOf('.') + 1)).toLowerCase();
            var extensions = ["jpg", "jpeg", "png", "pdf", "doc", 'docx'];

            if (!extensions || extensions.indexOf(extension) < 0) {
                this.form.validation = {
                    write_to: ["Please upload extensions file  " + extensions.toString()]
                };
                return false;
            }
            var formData = new FormData();
            formData.append('file', file);
            formData.append('upload', 'applications');

            this.form.validation = null;

            axios.post(ROOT_URL + '/uploads/file', formData)
                .then(response => {
                    this.file_miscellaneous = response.data.file_link;
                })
                .catch(function (err) {
                    this.form.validation = err.response.data.errors;
                });
        },
        uploadFileTotalPackage(e) {
            var file = e.target.files[0];
            var file_name = file ? file.name : '';

            var extension = file_name.substr((file_name.lastIndexOf('.') + 1)).toLowerCase();
            var extensions = ["jpg", "jpeg", "png", "pdf", "doc", 'docx'];

            if (!extensions || extensions.indexOf(extension) < 0) {
                this.form.validation = {
                    write_to: ["Please upload extensions file  " + extensions.toString()]
                };
                return false;
            }
            var formData = new FormData();
            formData.append('file', file);
            formData.append('upload', 'applications');

            this.form.validation = null;

            axios.post(ROOT_URL + '/uploads/file', formData)
                .then(response => {
                    this.file_total_package = response.data.file_link;
                })
                .catch(function (err) {
                    this.form.validation = err.response.data.errors;
                });
        },
    }

});
