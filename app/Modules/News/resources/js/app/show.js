Vue.component('news-index', {
    data() {
        return {
            route: 'news',
            news: [],
            lang: LANG,
            isLoading: false,
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
        this.fetchData();
    },
    watch: {},
    methods: {
        fetchData() {
            this.isLoading = true;
            axios.get(BASE_URL + '/' + this.route + '/data', {
                params: {
                    page: this.page.currentPage,
                }
            }).then(response => {
                this.isLoading = false;
                this.news = response.data.data;
                this.page.totalPages = response.data.meta.last_page;
                this.page.totalItems = response.data.meta.total;
            }).catch(error => {
                this.isLoading = false;
            });
        },
        nextPage(val) {
            this.page.currentPage = val;
            this.fetchData();
        },
    }
});
