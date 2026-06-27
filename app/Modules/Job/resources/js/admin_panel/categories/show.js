Vue.component('categories-show', {
    data() {
        return {
            data: [],
            dialogTitle: 'List Sort',
            pagination: {
                'current_page': 1
            }
        }
    },
    mounted() {
    },
    methods: {
        async fetchData({page, filter, sort}) {
            showLoading();
            const response = await axios.get(ADMIN_URL + '/jobs/categories/data', {params: {page, filter, sort}});
            hideLoading();
            return {
                data: response.data.data,
                pagination: {
                    currentPage: response.data.meta.current_page,
                    totalPages: response.data.meta.last_page
                }
            };
        },
        deleteItem(id, title) {
            Swal.fire({
                title: ' Are you sure to delete the salary range ' + title + '?',
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
                    axios.delete(ADMIN_URL + "/jobs/categories/" + id + "/delete").then(response => {
                        this.$refs.table.refresh();
                        hideLoading();
                        sweetAlertDelete();
                    }).catch(error => {
                        hideLoading();
                        swalError(error);
                    });
                }
            });
        },
    }
});
