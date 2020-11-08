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
  isResponsiveMenu: state => {
    return state.responsiveShopMenu;
  },
  initFront: state => {
    return state.initFront
  },
  isSetInitFront: state => {
    return state.initFront.init === true;
  },
  loader: state => {
    return state.loader;
  },
  model: state => {
    return state.models[state.currentKeyModel];
  },
  checkKeyModel: (state) => (key) => {
    return !!state.models[key];
  },
  typePage: state => {
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
}
