require('../../../../../resources/js/bootstrap');

import i18n from './lang/admin-lang';



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



require('./admin_panel/my-profle/basic-info/form');
require('./admin_panel/my-profle/change-password/form');

require('./admin_panel/admins/form');
require('./admin_panel/admins/show');

require('./admin_panel/roles/form');
require('./admin_panel/roles/show');


//Vue.component('upload-file', require('./components/UploadFileComponent.vue').default);
Vue.component('loading-button', require('./admin_panel/components/LoadingButton.vue').default);

const app = new Vue({
    el: '#admin',
    i18n,
});
