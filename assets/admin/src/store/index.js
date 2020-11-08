import Vue from 'vue'
import Vuex from 'vuex'
// import VuexPersist from 'vuex-persist';
// import localForage from 'localforage';
import auth from "./auth";
import menu from "./menu";
import helpers from "./helpers";
import item from "./item";
import popup from "./popup";

Vue.use(Vuex);
const createStore = () => {
	return new Vuex.Store({
		modules: {
			auth,
			helpers,
			popup,
			item,
			menu
		}
	});
};

export default createStore;
