Vue.component('mailing-lists-show', {
    data() {
        return {
            route: 'mailing-lists',
            data: [],
            pagination: {
                current_page: 1,
            }
        }
    },
    methods: {
        async fetchData({page, filter, sort}) {
            const response = await axios.get(ADMIN_URL + "/" + this.route + '/data', {params: {page, filter, sort}});
            return {
                data: response.data.data.data,
                pagination: {
                    currentPage: response.data.data.meta.current_page,
                    totalPages: response.data.data.meta.last_page
                }
            };
        },
    }
});
