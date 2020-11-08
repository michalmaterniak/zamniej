import store from '../store';
import router from '../router';
export default function auth(param) {
	if (store().getters.isAuth === false) {
		param.next({name: 'auth-login', params:{routerNext: router.currentRoute}});
	}
}
