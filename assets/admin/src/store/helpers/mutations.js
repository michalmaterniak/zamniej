export default {
	setLoading(context, payload) {
		context.loading = payload;
	},
  setDebug (state, payload) {
    state.debug.active = true;
    state.debug.token = payload.token;
    state.debug.dev = payload.dev;
  },
  setSearchTextListingPages(state, payload) {
	  state.searchTextListingPages = payload;
  }
}
