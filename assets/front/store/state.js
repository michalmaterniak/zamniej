

export default () => ({
  debug: {
    active: true,
    token: null,
    dev: [],
  },

  loader: true,
  responsiveShopMenu: false,

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

  search: {
    keywordsSearch: '',
    shops: [],
    isSearchContainer: false
  },
  favoriteShops: []
});
