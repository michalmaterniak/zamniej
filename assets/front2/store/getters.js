export default {
  redirectLinkOffer: state => id => {
    return state.initFront.data.linksRedirect.offer + '/' + id;
  },
  redirectLinkShop: state => id => {
    return state.initFront.data.linksRedirect.shop + '/' + id;
  },
  debug: state => {
    return state.debug;
  },
  initFront: state => {
    return state.initFront
  },
  isSetInitFront: state => {
    return state.initFront.init === true;
  },
  isLoader: state => {
    return state.loader;
  },
  model: state => {
    return state.models[state.currentKeyModel];
  },
  checkKeyModel: (state) => (key) => {
    return !!state.models[key];
  },
  typePage: state => {
    if (!state.models[state.currentKeyModel]) {
      return false;
    }
    return state.models[state.currentKeyModel].resourceType;
  },
  currentLocale: state => {
    return state.currentLocale;
  },
  seo: state => {
    return state.models[state.currentKeyModel].subpage.seo;
  },
  getPopup: state => {
    return state.popup;
  },
  leftSidebar: state => {
    return state.sidebar.left;
  },
  isSearchOpen: state => {
    return state.isSearchOpen;
  },
  favoriteShops: ({ favoriteShops }) => {
    return favoriteShops;
  }
}
