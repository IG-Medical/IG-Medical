require('../bootstrap');

import i18n from '../lang/admin-lang';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/en';

import TableComponent from 'vue-table-component';
Vue.use(TableComponent, {
    tableClass: 'table table-striped table-bordered m-table',
    theadClass: '',
    tbodyClass: '',
    filterInputClass: 'form-control',
    filterPlaceholder: 'search',
    filterNoResults: 'There is no data',
});
require('./mailing-lists/show');
Vue.use(ElementUI, {locale});

Vue.component('upload-file', require('./components/UploadFileComponent.vue').default);

const app = new Vue({
    el: '#admin',
    i18n,
});
