/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
import Lang from './lang'

import Vuex from 'vuex'

Vue.use(Vuex)
let app_locale = document.head.querySelector('meta[name="app_locale"]').content
if (!app_locale) app_locale = 'en'

const store = new Vuex.Store({
  state: {
    lang: app_locale
  },
  getters: {
    trans: (state, getters) => (key) => {
      Lang.setLocale(state.lang);
      return Lang.get(key);
    },
  },
  mutations: {
    spanish (state) {
      axios.put('/users/updatelang/es');
      state.lang = 'es'
    },
    english (state) {
      axios.put('/users/updatelang/en');
      state.lang = 'en'
    }
  }
})
const app = new Vue({
  el: '#app',
  store,
});

window.vm = app;