require('../../../../../resources/js/bootstrap');

import i18n from './lang/admin-lang';
import TableComponent from 'vue-table-component';
import tinymce from 'vue-tinymce-editor';
Vue.component('tinymce', tinymce);
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/en';

Vue.use(TableComponent, {
    tableClass: 'table table-striped table-bordered m-table',
    theadClass: '',
    tbodyClass: '',
    filterInputClass: 'form-control',
    filterPlaceholder: 'search',
    filterNoResults: 'There is no data',
});

Vue.use(ElementUI, {locale});

Vue.component('upload-file', require('./admin_panel/components/UploadFileComponent.vue').default);
Vue.component('el-multiple-file-upload', require('./admin_panel/components/ELMultipleUploadFile').default);

require('./admin_panel/products/show');
require('./admin_panel/products/form');

require('./admin_panel/attribute-sets/show');
require('./admin_panel/attribute-sets/form');

require('./admin_panel/attributes/show');
require('./admin_panel/attributes/form');

require('./admin_panel/options/show');
require('./admin_panel/options/form');




const app = new Vue({
    el: '#admin',
    i18n
});
