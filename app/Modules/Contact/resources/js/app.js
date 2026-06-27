require('../../../../../resources/js/bootstrap');

import i18n from './lang/app-lang';
import store from "../../../../../resources/js/store/store";

import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast);

require('./app/contact_us');


Vue.component('subscribe-email-component', require('./../../../../../resources/js/app/components/SubscribeEmailComponent').default);

const app = new Vue({
    el: '#app',
    i18n,
    store: store,
});
