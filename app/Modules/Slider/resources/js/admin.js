require('../../../../../resources/js/bootstrap');

import i18n from './lang/admin-lang';
import TableComponent from 'vue-table-component';

Vue.use(TableComponent, {
    tableClass: 'table table-striped table-bordered m-table',
    theadClass: '',
    tbodyClass: '',
    filterInputClass: 'form-control',
    filterPlaceholder: 'search',
    filterNoResults: 'There is no data',
});

Vue.component('upload-file', require('./admin_panel/components/UploadFileComponent.vue').default);

require('./admin_panel/form');
require('./admin_panel/show');

const app = new Vue({
    el: '#admin',
    i18n
});
