export default {
	user: state => {
		return state.auth.user;
	},
	token: state => {
		return state.auth.token;
	},
	isAuth: state => {
		return state.auth.isAuth;
	}
}
