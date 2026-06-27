require('../../../../../resources/js/bootstrap');
import i18n from './lang/admin-lang';

import tinymce from 'vue-tinymce-editor';
Vue.component('tinymce', tinymce);

require('./admin_panel/settings/custom-css-js');
require('./admin_panel/settings/maintenance');
require('./admin_panel/settings/email');
require('./admin_panel/settings/general');

require('./admin_panel/appearance/social-links');
require('./admin_panel/appearance/contact-info');
require('./admin_panel/appearance/logo');
require('./admin_panel/appearance/general');
require('./admin_panel/appearance/features');
require('./admin_panel/appearance/footer');
require('./admin_panel/appearance/home-page');
require('./admin_panel/appearance/how-it-work');
require('./admin_panel/appearance/about-us');
require('./admin_panel/appearance/certifications');
require('./admin_panel/appearance/breadcrumbs');
require('./admin_panel/appearance/titles');


Vue.component('upload-file', require('./admin_panel/components/UploadFileComponent.vue').default);
const app = new Vue({
    el: '#admin',
    i18n
});
