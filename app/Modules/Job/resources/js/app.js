require('../../../../../resources/js/bootstrap');

import i18n from './lang/app-lang';

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/de';
Vue.use(ElementUI, {locale});

import tinymce from 'vue-tinymce-editor';
Vue.component('tinymce', tinymce);


import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast);

require('./app/job/show');
require('./app/job/view');


Vue.component('subscribe-email-component', require('./../../../../../resources/js/app/components/SubscribeEmailComponent').default);

const app = new Vue({
    el: '#app',
    i18n,
});
