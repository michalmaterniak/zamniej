export default {
	setUser(state, payload) {
		state.auth.user = payload;
	},
	setToken(state, payload) {
		state.auth.token = payload;
	},
	setAuth(state, payload) {
		state.auth.isAuth = payload;
	},
}
