export default {
	getPopup: state => {
		return state.popup;
	},
	getPopupOptions: state => {
		return state.popup.options ? state.popup.options : state.popup.defaultOptions;
	},
	getPopupDefaultOptions: state => {
		return state.popup.defaultOptions;
	}
}
