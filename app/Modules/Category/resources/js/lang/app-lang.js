import Vue from 'vue';
import VueI18n from 'vue-i18n';

import ar from './ar';
import en from './en';

Vue.use(VueI18n);

const locale = LANG;

const messages = {
    ar,
    en,
};

const i18n = new VueI18n({
    locale,
    messages
});

export default i18n;
