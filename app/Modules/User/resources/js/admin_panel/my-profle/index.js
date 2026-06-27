Vue.component('admin-profile-index', {
    data() {
        return {
            route:'admins/profile',
            id: null,
            first_name: '',
            last_name: '',
            password: '',
            password_confirmation: '',
            email: '',
            mobile: '',
            role: '',
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
            show: false,
            headers: {
                'X-CSRF-TOKEN': TOKN,
            },
            imgDataUrl: userImageDefault() // the base64 url of created image
        }
    },
    methods: {


    }
});
