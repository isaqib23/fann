import 'babel-polyfill'
import Vue from 'vue'
import _ from 'lodash'

import router from '~/router/index'
import store from '~/store/index'
import App from '$comp/App'
import '~/plugins/index'
import vuetify from '~/plugins/vuetify'
import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';
import Vuelidate from 'vuelidate'
import VueCreditCardField from 'vue-credit-card-field';
import axios from 'axios';
import { api } from '~/config';


const moment = require('moment')
require('moment/locale/es')

window.Vue = Vue;
window._ = _;
window.axios = axios;
window.api = api;
window.moment = require('moment');

Vue.use(Vuelidate);
Vue.use(VueInternationalization);
Vue.use(VueCreditCardField);
Vue.use(require('vue-moment'), {
    moment
});

const lang = document.documentElement.lang.substr(0, 2);
const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});

export const app = new Vue({
  router,
  store,
  vuetify,
  i18n,
  render: h => h(App)
}).$mount('#app');
