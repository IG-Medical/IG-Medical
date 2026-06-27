require('../../../../../resources/js/bootstrap');

import i18n from './lang/app-lang';

import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)

require('./app/show');

Vue.component('subscribe-email-component', require('./../../../../../resources/js/app/components/SubscribeEmailComponent').default);

const app = new Vue({
    el: '#app',
    i18n,
});
