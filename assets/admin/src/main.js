
import Vue from 'vue'
import Vuex from 'vuex'
import App from './App.vue'
import router from './router'
import store from './store'
// import dotenv from 'dotenv'
import axios from 'axios'
import toastr from "toastr";

import VueAxios from 'vue-axios'
import VueMoment from 'vue-moment'
import '../node_modules/toastr/build/toastr.min.css';
import '../node_modules/vue-datetime/dist/vue-datetime.min.css';

Vue.use(Vuex);

Vue.use(VueAxios, axios);
Vue.use(VueMoment);
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
Vue.component('v-select', vSelect)
import CKEditor from 'ckeditor4-vue';
import { Datetime } from 'vue-datetime';
Vue.component('datetime', Datetime);
Vue.use(CKEditor);
window.jQuery = window.$ = window.jquery = require('jquery');



import 'bootstrap';
import _ from 'lodash';
import './assets/assets/libs/popper.js/dist/popper.min.js'
import './assets/dist/js/waves';
import './assets/dist/css/style.min.css';



//mixins
import helpers from "./mixins/helpers";


Vue.mixin(helpers);


Vue.config.productionTip = false
new Vue({
	router,
	store,
	render: h => h(App)
}).$mount('#app')
