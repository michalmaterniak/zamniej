import Vue from "vue";
import VueRouter from 'vue-router';

import routes from "./routes";
import meta from "../middleware/meta";

Vue.use(VueRouter);

const index = new VueRouter({
  duplicateNavigationPolicy: 'ignore',
	routes
});

index.beforeEach((to, from, next) => {
	meta({to, from, next});
	if (to.meta.middleware) {
		to.meta.middleware.forEach((func) => {
			func({to, from, next});
		});
	}
	next();

});

export default index;
