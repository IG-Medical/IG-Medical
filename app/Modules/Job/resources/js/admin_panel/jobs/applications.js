Vue.component('applications-show', {
    data() {
        return {
            dialogVisible: false,
            application: null,
            filter: {
                careerId:null,
            },
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            }
        }
    },
    props: {
        career: null,
    },
    watch: {},
    mounted() {

    },
    methods: {
        async fetchData({page, filter, sort}) {
            if(this.career) {
                this.filter.careerId = this.career.id;
            }
            let url = ADMIN_URL + '/jobs/applications/data';

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
        getDetailsApplication(id) {
            axios.get(ADMIN_URL + '/jobs/applications/' + id + '/details', {}).then(response => {
                this.application = response.data.data;
                this.dialogVisible = true;
            }).catch(error => {
            });
        },
    }
});
