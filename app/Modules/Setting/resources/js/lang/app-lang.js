import Vue from 'vue';
import VueI18n from 'vue-i18n';

import de from './de';

Vue.use(VueI18n);

const locale = LANG;

const messages = {
    de,
};

const i18n = new VueI18n({
    locale,
    messages
});

export default i18n;
