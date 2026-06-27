Vue.component('news-show', {
    data() {
        return {
            data: [],
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
            const response = await axios.get(ADMIN_URL + '/news/data', {params: {page, filter, sort}});
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
                title: ' Are you sure to delete the news ' + title + '?',
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
                    axios.delete(ADMIN_URL + "/news/" + id + "/delete").then(response => {
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
