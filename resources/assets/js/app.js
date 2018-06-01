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
Vue.component('league-create', require('./components/leagues/Create.vue'));
Vue.component('league-invite', require('./components/leagues/Invite.vue'));
Vue.component('league-summary', require('./components/leagues/Summary.vue'));
Vue.component('league-join', require('./components/leagues/Join.vue'));
Vue.component('predictions-index', require('./components/predictions/PredictionsIndex.vue'));
Vue.component('group-prediction', require('./components/predictions/GroupPrediction.vue'));
Vue.component('match-prediction', require('./components/predictions/MatchPrediction.vue'));
Vue.component('ranking-index', require('./components/ranking/Ranking.vue'));
Vue.component('spinner', require('./components/Utils/Spinner.vue'));
Vue.component('change-password', require('./components/Utils/ChangePassword.vue'));
Vue.component('game-summary', require('./components/Utils/GameSummary.vue'));
import Lang from './lang'
import Vuex from 'vuex'
Vue.use(Vuex)

var SocialSharing = require('vue-social-sharing');
Vue.use(SocialSharing);

var Foundation = require('foundation-sites/dist/js/foundation'); // 'foundation.min' can also be used if you like
Vue.use(Foundation);
$(document).foundation();

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
  data(){
    return {
      loaded:false
    }
  },
  mounted(){
    this.loaded = true
  }
});

window.vm = app;