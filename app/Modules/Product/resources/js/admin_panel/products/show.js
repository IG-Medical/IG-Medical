Vue.component('products-show', {
    data() {
        return {
            route: 'products',
            data: [],
            pagination: {
                'current_page': 1
            },
            dialogVisible: {
                FormDiscount: false,
                FormQTY: false,
            },
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
            product_id: null,
            qty: null,
            discount_percentage: null,
            showTrashed: false,
        }
    },
    mounted() {
    },
    watch: {
        "dialogVisible.FormDiscount": function (val) {
            if (!val) {
                this.resetForm();
            }
        },
        "dialogVisible.FormQTY": function (val) {
            if (!val) {
                this.resetForm();
            }
        },
    },
    methods: {
        async fetchData({page, filter, sort}) {
            showLoading();
            const params = {page, filter, sort};
            // Add trashed parameter if showing deleted items
            if (this.showTrashed) {
                params.trashed = 1;
            }
            const response = await axios.get(ADMIN_URL + '/' + this.route + '/data', {params});
            hideLoading();
            return {
                data: response.data.data.data,
                pagination: {
                    currentPage: response.data.data.meta.current_page,
                    totalPages: response.data.data.meta.last_page
                }
            };
        },
        openQTYModal(id) {
            this.product_id = id;
            this.dialogVisible.FormQTY = true;
        },
        openDiscountModal(id) {
            this.product_id = id;
            this.dialogVisible.FormDiscount = true;
        },
        resetForm() {
            this.product_id = null;
            this.qty = null;
            this.discount_percentage = null;
        },
        saveQTY() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/update', {
                id: this.product_id,
                qty: this.qty,
            }).then(response => {
                this.dialogVisible.FormQTY = false;
                this.resetForm();
                swalSuccess(response.data.message);
                this.$refs.table.refresh();
            }).catch(error => {
                this.form.disabledButton = false;
                this.form.loadingDisplay = false;
                this.form.validation = error.response.data.errors;
            })
        },
        saveDiscount() {
            this.form.disabledButton = true;
            this.form.loadingDisplay = true;
            this.form.validation = null;
            axios.post(ADMIN_URL + '/' + this.route + '/update', {
                id: this.product_id,
                discount_percentage: this.discount_percentage,
            }).then(response => {
                this.dialogVisible.FormDiscount = false;
                this.resetForm();
                swalSuccess(response.data.message);
                this.$refs.table.refresh();
            }).catch(error => {
                this.form.disabledButton = false;
                this.form.loadingDisplay = false;
                this.form.validation = error.response.data.errors;
            })
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
        },
        restoreItem(id, name) {
            Swal.fire({
                title: this.$t('art_you_restore',{name:name}),
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
                    axios.put(ADMIN_URL + "/" + this.route + "/" + id + "/restore").then(response => {
                        this.$refs.table.refresh();
                        hideLoading();
                        swalSuccess(response.data.message);
                    }).catch(error => {
                        hideLoading();
                        swalError(error);
                    });
                }
            });
        },
        forceDeleteItem(id, name) {
            Swal.fire({
                title: this.$t('art_you_force_delete',{name:name}),
                text: "",
                type: 'error',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes, delete permanently',
            }).then((result) => {
                if (result.value) {
                    showLoading();
                    axios.delete(ADMIN_URL + "/" + this.route + "/" + id + "/force-delete").then(response => {
                        this.$refs.table.refresh();
                        hideLoading();
                        sweetAlertDelete(response.data.message);
                    }).catch(error => {
                        hideLoading();
                        swalError(error);
                    });
                }
            });
        },
        toggleTrashed() {
            this.showTrashed = !this.showTrashed;
            this.$refs.table.refresh();
        }
    }
});
