require('../../../../../resources/js/bootstrap');
import i18n from './lang/admin-lang';


import tinymce from 'vue-tinymce-editor';
Vue.component('tinymce', tinymce);

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/de';
Vue.use(ElementUI, {locale});

import TableComponent from 'vue-table-component';
Vue.use(TableComponent, {
    tableClass: 'table table-striped table-bordered m-table',
    theadClass: '',
    tbodyClass: '',
    filterInputClass: 'form-control',
    filterPlaceholder: 'search',
    filterNoResults: 'There is no data',
});




require('./admin_panel/jobs/applications');
require('./admin_panel/categories/form');
require('./admin_panel/categories/show');

require('./admin_panel/jobs/form');
require('./admin_panel/jobs/show');
require('./admin_panel/jobs/details');
const app = new Vue({
    el: '#admin',
    i18n
});
