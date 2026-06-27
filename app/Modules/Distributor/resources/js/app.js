require('../../../../../resources/js/bootstrap');

import i18n from './lang/app-lang';


import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast);

Vue.component('subscribe-email-component', require('./../../../../../resources/js/app/components/SubscribeEmailComponent').default);


const app = new Vue({
    el: '#app',
    i18n,
});
