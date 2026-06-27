require('../../../../../resources/js/bootstrap');

import i18n from './lang/admin-lang';
import tinymce from 'vue-tinymce-editor';
import TableComponent from 'vue-table-component';

Vue.use(TableComponent, {
    tableClass: 'table table-striped table-bordered m-table',
    theadClass: '',
    tbodyClass: '',
    filterInputClass: 'form-control',
    filterPlaceholder: 'search',
    filterNoResults: 'There is no data',
});

Vue.component('tinymce', tinymce);
Vue.component('slug', require('./admin_panel/components/SlugComponent.vue').default);


require('./admin_panel/form');
require('./admin_panel/show');

const app = new Vue({
    el: '#admin',
    i18n
});
