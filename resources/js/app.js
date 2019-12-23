/*import files/objects*/
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
import { api } from '~/config'

import '~/pusher/init'

/*window level objects*/
window.Vue = Vue;
window._ = _;
window.axios = axios;
window.api = api;

/*use packages*/
Vue.use(Vuelidate);
Vue.use(VueInternationalization);
Vue.use(VueCreditCardField);

/*define constants*/
const lang = document.documentElement.lang.substr(0, 2);
const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});

/*initialize VUE instance*/
export const app = new Vue({
  router,
  store,
  vuetify,
  i18n,
  render: h => h(App)
}).$mount('#app');
