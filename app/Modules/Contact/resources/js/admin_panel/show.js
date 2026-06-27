Vue.component('contact-us-admin-show', {
    data() {
        return {
            route: 'contacts',
            messages: [],
            pagination: {
                'current_page': 1
            }
        }
    },
    props: {
        id: null,
    },
    methods: {
        async fetchData({page, filter, sort}) {
            let url = ADMIN_URL + '/' + this.route + '/data';
            if (this.id) {
                url = ADMIN_URL + '/' + this.route + '/data?id=' + this.id;
            }
            showLoading();
            const response = await axios.get(url, {params: {page, filter, sort}});
            hideLoading();
            return {
                data: response.data.data.data,
                pagination: {
                    currentPage: response.data.data.meta.current_page,
                    totalPages: response.data.data.meta.last_page
                }
            };
        },
        async fetchArchivedData({page, filter, sort}) {
            let url = ADMIN_URL + '/' + this.route + '/data?status=1';
            if (this.id) {
                url = ADMIN_URL + '/' + this.route + '/data?status=1&id=' + this.id;
            }
            showLoading();
            const response = await axios.get(url, {params: {page, filter, sort}});
            hideLoading();
            return {
                data: response.data.data.data,
                pagination: {
                    currentPage: response.data.data.meta.current_page,
                    totalPages: response.data.data.meta.last_page
                }
            };
        },
        archive(id, name) {
            Swal.fire({
                title: ' Are you sure to Archive the message ' + name + '?',
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
                    axios.put(ADMIN_URL + '/' + this.route + '/' + id + '/archive').then(response => {
                        this.$refs.table.refresh();
                        this.$refs.table1.refresh();
                        hideLoading();
                        sweetAlertDelete('Archived!');
                    }).catch(error => {
                        hideLoading();
                        swalError(error);
                    });
                }
            });
        }
    }
});

