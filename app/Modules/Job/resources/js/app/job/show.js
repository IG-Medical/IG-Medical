Vue.component('jobs-show', {
    data() {
        return {
            route: 'jobs',
            isLoading: false,
            jobs: [],
            categories: [],
            filter: {
                category: '',
                location: '',
            },
            page: {
                currentPage: 1,
                totalPages: 0,
                totalItems: 0,
                itemsPerPage: 10
            },
        }
    },
    props: {},
    mounted() {
        this.getCategories();
        this.fetchData();
    },
    watch: {
        // "filter.category": function (val) {
        //     if (val) {
        //         this.fetchData();
        //     }
        // },
        // "filter.location": function (val) {
        //     if (val) {
        //         this.fetchData();
        //     }
        // },
    },
    methods: {
        getCategories() {
            axios.get(BASE_URL + '/jobs/categories/all', {}).then(response => {
                this.categories = response.data.data;
            }).catch(error => {
            });
        },
        fetchData() {
            this.isLoading = true;
            axios.get(BASE_URL + '/' + this.route + '/data', {
                params: {
                    filter: this.filter
                }
            }).then(response => {
                this.isLoading = false;
                if (this.page.currentPage === 1) {
                    this.page.totalItems = response.data.data.meta.total;
                    this.jobs = response.data.data.data;
                } else {
                    this.jobs = [].concat(this.jobs, response.data.data.data);
                }
            }).catch(error => {
                this.isLoading = false;
            });
        },
        getMore: function () {
            if (this.jobs.length < this.page.totalItems) {
                this.page.currentPage++;
                this.fetchData();
            }
        },
    }
});
