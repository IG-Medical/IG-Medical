Vue.component('jobs-show', {
    data() {
        return {
            dialogVisibleAddUsersToSpecialJob: false,
            data: [],
            skills: [],
            openAdvancedSearch: false,
            filter: {
                text: '',
                job_id: null,
                title: null,
                user_id: null,
                wallet_id: null,
                full_name: null,
                email: null,
                descriptions: null,
                professions: [],
                skills: [],
                salary: '',
                status: '',
                created_at: null,
                date_publication: null,
                company_industry: '',
                no_of_vacancies: null,
                level: '',
                country: null,
                remote_career: false,
                number_of_applicants: {
                    from: null,
                    to: null,
                },
            },
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
            users: [],
            pagination: {
                'current_page': 1
            },
            isLoading: false,
            selectUser: null,
            career_id: null,
            user_ids: [],
        }
    },
    props: {
        filterId: null
    },
    watch: {
        "filter.professions": function (objProfession) {
            if (objProfession) {
                let listSkills = [];
                if (objProfession.length) {
                    $.each(objProfession, function (key, value) {
                        if (value.skills.length) {
                            $.each(value.skills, function (key, value) {
                                listSkills.push(value);
                            });
                        }
                    });
                    this.skills = listSkills;
                } else {
                    this.skills = []; // clear list skills
                    this.filter.skills = []; // clear selected user skills
                }
            }
        },
        selectUser: function (val) {
            let users = [];
            if (val.length > 0) {
                $.each(val, (key, value) => {
                    users.push(value.id);
                });
                this.user_ids = users;
            } else {
                this.user_ids = [];
            }
        },
    },
    mounted() {
    },
    methods: {
        showModalAddUsersToSpecialJob(id) {
            showLoading();
            this.career_id = id;
            axios.get(ADMIN_URL + "/special-job-user/users", {
                params: {
                    career_id: this.career_id,
                }
            }).then(response => {
                hideLoading();
                this.selectUser = response.data;
                this.dialogVisibleAddUsersToSpecialJob = true;
            }).catch(error => {
                hideLoading();
                swalError(error);
            });
        },
        addUsersToSpecialJob() {
            this.form.disabledButton = true;
            showLoading();
            axios.post(ADMIN_URL + "/special-job-user/store", {
                user_ids: this.user_ids,
                career_id: this.career_id,
            }).then(response => {
                this.form.disabledButton = false;
                this.dialogVisibleAddUsersToSpecialJob = false;
                this.user_ids = [];
                this.selectUser = [];
                this.career_id = null;
                hideLoading();
                swalSuccess(response.data.message);
            }).catch(error => {
                this.form.disabledButton = false;
                hideLoading();
                swalError(error);
            });
        },
        getUsers(query) {
            this.isLoading = true;
            if (query.length > 0) {
                this.queryData = JSON.parse(JSON.stringify(query));
                axios.get(BASE_URL + '/users/end-point/search?q=' + escape(query))
                    .then((response) => {
                        this.isLoading = false;
                        this.users = response.data;
                    })
                    .catch((error) => {
                        this.isLoading = false;
                        swalError(error);
                    });
            } else
                this.isLoading = false;
        },
        doFilter() {
            this.$refs.table.pagination.currentPage = 1
            this.$refs.table.refresh();
        },
        resetFilter() {
            this.filter = {
                text: '',
                job_id: null,
                title: null,
                user_id: null,
                wallet_id: null,
                full_name: null,
                email: null,
                descriptions: null,
                professions: [],
                skills: [],
                salary: '',
                status: '',
                created_at: null,
                date_publication: null,
                company_industry: '',
                no_of_vacancies: null,
                level: '',
                country: null,
                remote_career: false,
                number_of_applicants: {
                    from: null,
                    to: null,
                },
            };
            this.$refs.table.refresh();
        },
        async fetchData({page, filter, sort}) {
            let url;
            if (this.filterId) {
                url = ADMIN_URL + '/jobs/data?id=' + this.filterId;
            } else {
                url = ADMIN_URL + '/jobs/data';
            }
            this.filter.text = filter;
            filter = this.filter;
            showLoading();
            const response = await axios.get(url, {params: {page, filter, sort}});
            hideLoading();
            return {
                data: response.data.data,
                pagination: {
                    currentPage: response.data.meta.current_page,
                    totalPages: response.data.meta.last_page
                }
            };
        },
        showAdvancedSearch() {
            this.openAdvancedSearch = !this.openAdvancedSearch;
        },
        accept(id, name) {
            Swal.fire({
                title: ' Are you sure to accept the job ' + name + '?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.value) {
                    showLoading();
                    axios.put(ADMIN_URL + "/jobs/" + id + "/accept").then(response => {
                        this.$refs.table.refresh();
                        swalSuccess(response.data.message);
                    }).catch(error => {
                        swalError(error);
                    });
                }
            });
        },
        reject(id, name) {
            Swal.fire({
                title: ' Are you sure to reject the job ' + name + '?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        input: 'textarea',
                        inputLabel: 'The reason',
                        inputPlaceholder: 'Type your reason here...',
                        inputAttributes: {
                            'aria-label': 'Type your reason here'
                        },
                        showCancelButton: true
                    }).then((result) => {
                        if (result.value) {
                            showLoading();
                            axios.put(ADMIN_URL + "/jobs/" + id + "/reject?reason=" + result.value).then(response => {
                                this.$refs.table.refresh();
                                swalSuccess(response.data.message);
                            }).catch(error => {
                                swalError(error);
                            });
                        }
                    });
                }
            });
        },
        deleteJob(id, title) {
            Swal.fire({
                title: ' Are you sure to delete the job level ' + title + '?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.value) {
                    showLoading();
                    axios.delete(ADMIN_URL + "/jobs/" + id + "/delete").then(response => {
                        this.$refs.table.refresh();
                        hideLoading();
                        sweetAlertDelete();
                    }).catch(error => {
                        hideLoading();
                        swalError(error);
                    });
                }
            });
        }
    }
});
