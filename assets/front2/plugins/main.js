import Vue from 'vue'

import Vue2TouchEvents from 'vue2-touch-events'
import VueClipboard from 'vue-clipboard2'
VueClipboard.config.autoSetContainer = true;
// This is important, we are going to let Nuxt.js worry about the CSS

// Register the component globally
Vue.use(Vue2TouchEvents)
Vue.use(VueClipboard);

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue)
// import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


Number.prototype.round = function(places) {
  return +(Math.round(this + "e+" + places)  + "e-" + places);
}
