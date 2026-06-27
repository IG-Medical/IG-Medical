Vue.component('testimonials-show', {
    data() {
        return {
            route: 'testimonials',
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
            const response = await axios.get(ADMIN_URL + '/' + this.route + '/data', {params: {page, filter, sort}});
            hideLoading();
            return {
                data: response.data.data.data,
                pagination: {
                    currentPage: response.data.data.meta.current_page,
                    totalPages: response.data.data.meta.last_page
                }
            };
        },
        deleteItem(id, name) {
            Swal.fire({
                title: this.$t('art_you_delete',{name:name}),
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
                    axios.delete(ADMIN_URL + "/" + this.route + "/" + id + "/delete").then(response => {
                        this.$refs.table.refresh();
                        hideLoading();
                        sweetAlertDelete(response.data.message);
                    }).catch(error => {
                        hideLoading();
                        swalError(error);
                    });
                }
            });
        }
    }
});
