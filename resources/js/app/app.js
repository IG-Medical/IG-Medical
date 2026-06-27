require('./../bootstrap');

import i18n from '../lang/app-lang';

// import ElementUI from 'element-ui';
// import 'element-ui/lib/theme-chalk/index.css';
// import locale from "element-ui/lib/locale/lang/en";
// Vue.use(ElementUI, {locale});


// import Paginate from "vuejs-paginate";
// Vue.component('paginate', Paginate)

import 'vue-toast-notification/dist/theme-sugar.css';
import VueToast from 'vue-toast-notification';
Vue.use(VueToast);


Vue.component('subscribe-email-component', require('./components/SubscribeEmailComponent').default);

const app = new Vue({
    el: '#app',
    i18n,
});
