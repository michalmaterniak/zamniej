export default {
	isLoading: state => {
		return state.loading;
	},
  debug: state => {
    return state.debug;
  },
  searchTextListingPages: state => {
    return state.searchTextListingPages;
  },
  getListingOffersQueue: state => {
    return state.listingOffersQueue;
  }
}
