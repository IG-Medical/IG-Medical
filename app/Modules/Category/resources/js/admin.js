require('../../../../../resources/js/bootstrap');

import i18n from './lang/admin-lang';

import tinymce from 'vue-tinymce-editor';
Vue.component('tinymce', tinymce);

require('./admin_panel/index');

Vue.component('upload-file', require('./admin_panel/components/UploadFileComponent.vue').default);

const app = new Vue({
    el: '#admin',
    i18n
});
