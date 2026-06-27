<template>
    <div class="col-md-3 col-12 mb-4 mb-md-0 text-sm-center">
        <h6>{{$t('stay_updated_with_our_newsletter')}}</h6>
        <div class="row">
            <div class="col-md-12 col-12 text-sm-center">
                <form>
                    <div class="form-group">
                        <input v-model="full_name" class="form-control d-block fs-14" :placeholder="$t('ihr_name')" type="text">
                        <span v-if="form.validation&&form.validation.full_name" class="error">{{form.validation.full_name[0]}}</span>
                    </div>
                    <div class="form-group">
                        <input v-model="email" class="form-control d-block fs-14" :placeholder="$t('email_address')" type="text">
                        <span v-if="form.validation&&form.validation.email" class="error">{{form.validation.email[0]}}</span>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input id="agree1" v-model="agree" class="form-check-input" type="checkbox">
                            <label class="form-check-label" for="agree1">{{$t('i_have_read_and_noted_the_data_protection_declaration')}}</label>
                            <span v-if="form.validation&&form.validation.agree" class="error">{{ form.validation.agree[0] }}</span>
                        </div>
                    </div>
                    <button v-if="agree" :disabled="form.disabledButton" class="btn btn-primary fs-14" type="button" @click="save">{{$t('register')}}</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
//import VueRecaptcha from "vue-recaptcha";

export default {
    props: ['recaptchaKey'],
    data() {
        return {
            contRequest: 0,
            showRecaptcha: false,
            email: '',
            full_name: '',
            agree: false,
            form: {
                validation: null,
                disabledButton: false,
                loadingDisplay: false,
            },
        }
    },
    components: {
        // VueRecaptcha,
    },
    mounted() {
    },
    methods: {
        refreshRecaptcha() {
            if (this.contRequest > 3) {
                this.$refs.recaptcha.reset();
            }
        },
        onVerify(response) {
            this.recaptcha = response;
        },
        save() {
            this.form.loadingDisplay = true;
            this.form.disabledButton = true;
            this.form.validation = null;
            axios.post(BASE_URL + '/subscribe-email', {
                email: this.email,
                full_name: this.full_name,
                agree: this.agree,
                recaptcha: this.recaptcha,
            }).then(response => {
                this.resetModal();
                toastSuccess(response.data.message);
            }).catch(error => {
                //this.$refs.recaptcha.reset();
                this.form.disabledButton = false;
                this.form.loadingDisplay = false;
                this.form.validation = error.response.data.errors;
                if (error.response.status == 429) {
                    this.form.validation = {email: [error.response.data.message]};
                }
                // this.contRequest = error.response.data.data.currentAttempts['currentAttempts'];
            });
        },
        resetModal() {
            this.email = '';
            this.full_name = null;
            this.recaptcha = null;
            this.agree = false;
            this.form.disabledButton = false;
            this.form.loadingDisplay = false;
            this.form.validation = null;
            //this.$refs.recaptcha.reset();
        }
    }
}
</script>

<style scoped>

</style>
