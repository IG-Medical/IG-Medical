require('../../../../../resources/js/bootstrap');

import i18n from './lang/app-lang';
import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)

import Multiselect from 'vue-multiselect';
import "vue-multiselect/dist/vue-multiselect.min.css"
Vue.component('multiselect', Multiselect); // register globally


import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast);

require('./app/search/show');
require('./app/details/index');
require('./app/customized');
require('./app/download-pdf-product');

Vue.component('subscribe-email-component', require('./../../../../../resources/js/app/components/SubscribeEmailComponent').default);

const app = new Vue({
    el: '#app',
    i18n,
});
