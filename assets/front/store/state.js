

export default () => ({
  debug: {
    active: true,
    token: null,
    dev: [],
  },
  loader: false,
  sidebar: {
    left: false,
    right: false
  },

  isSearchOpen: false,

  initFront: {
    init: false,
    data:{
      links: {
        categories: null,
        footer: null,
        navbar: null,
      },
      linksRedirect: {
        shop: null,
        offer: null
      }
    }
  },

  models: {},
  currentLocale: 'pl',
  currentKeyModel: null,

  popup: {
    options: {},
    data: {},
    title: '',
    template: null,
  },
  isPopup: false,
  isTapTop: false,

  search: {
    keywordsSearch: '',
    shops: [],
    isSearchContainer: false
  },
  favoriteShops: [],

  shopDetailOpen: false

});
