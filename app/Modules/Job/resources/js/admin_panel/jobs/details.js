Vue.component('job-details', {
    data() {
        return {

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
    watch: {

    },
    mounted() {
        if (this.career) {
        }
    },
    methods: {

    }
});
