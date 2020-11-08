export default {
	setPopupData(state, payload) {

		state.popup.options = Object.assign({}, state.popup.defaultOptions, payload.options);
		state.popup.title = payload.title;
	},
}
