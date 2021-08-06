import sitemap from "./config/sitemap";

var webpack = require('webpack');

export default {
  /*
  ** Nuxt rendering mode
  ** See https://nuxtjs.org/api/configuration-mode
  */
  mode: 'universal',
  runtimeCompiler: true,
  /*
  ** Nuxt target
  ** See https://nuxtjs.org/api/configuration-target
  */
  target: 'server',
  /*
  ** Headers of the page
  ** See https://nuxtjs.org/api/configuration-head
  */
  head: {
    title: process.env.npm_package_name || '',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: process.env.npm_package_description || '' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/page2/icon64x64.png' }
    ],
    noscript: [
      { innerHTML: "<style>div.loader_skeleton {display: none;}</style>"}
    ],
    __dangerouslyDisableSanitizers: ['noscript']
  },
  loading: false,
  router:{
    middleware: ['middleware'],
  },
  /*
  ** Build configuration
  ** See https://nuxtjs.org/api/configuration-build/
  */
  build: {
    vendor: ['jquery', 'popper.js', 'lodash', 'bootstrap'],
    plugins: [
      // set shortcuts as global for bootstrap
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
        jquery: 'jquery',
        'window.jQuery': 'jquery',
        _: 'lodash',
        bootstrap: 'bootstrap'
      })
    ],


    /*
    ** You can extend webpack config here
    */
    extend (config, ctx) {
    }
  },
  /*
  ** Global CSS
  */
  css: [
    '@/assets/css/fontawesome.css',
    '@/assets/css/slick.css',
    '@/assets/css/slick-theme.css',
    '@/assets/css/animate.css',
    '@/node_modules/bootstrap/dist/css/bootstrap.css',
    '@/assets/css/color1.css'
  ],
  /*
  ** Plugins to load before mounting the App
  ** https://nuxtjs.org/guide/plugins
  */
  plugins: [
    { src: '@/plugins/main.js' },
    { src: '@/plugins/main.client.js' },
    { src: '@/plugins/main.server.js' },
    { src: '@/plugins/functions.js' },
    { src: '~/node_modules/bootstrap/dist/js/bootstrap.js', mode: 'client' },
    { src: '~/assets/js/lazysizes.min.js', mode: 'client' },
  ],
  /*
  ** Auto import components
  ** See https://nuxtjs.org/api/configuration-components
  */
  components: true,
  /*
  ** Nuxt.js dev-modules
  */
  buildModules: [
    '@nuxtjs/gtm',
    '@nuxtjs/moment'
  ],
  moment: {
    locales: ['pl']
  },
  gtm: {
    id: process.env.GTM
  },
  /*
  ** Nuxt.js modules
  */
  modules: [
    '@nuxtjs/axios',
    '@nuxtjs/pwa',
    '@nuxtjs/sitemap',
    [
      '@nuxtjs/component-cache',
      {
        max: 10000,
        maxAge: 1000 * 60 * 60
      }
    ],
    ['nuxt-lazy-load', {
      // defaultImage: '/page2/images/ajax-loader.gif',
    }]
  ],
  pwa: {
    meta: {
      title: 'Za Mniej',
      author: 'Michał Materniak COMMIT-M',
    },
    icon: {
      source: '/page2/images/icon/2.png'
    },
    manifest: {
      name: 'ZaMniej.pl',
      short_name: 'zamniej.pl',
      lang: 'pl',
      display: 'standalone',
      theme_color:	"#ff6600",
      background_color:	"#ffffff",
      icons:[
        {
          src: '/page2/images/icon/2.png',
          sizes: '10x10',
          type: 'image/png'
        }
      ]
    },
  },

  sitemap,

  /*
  ** Axios module configuration
  ** See https://axios.nuxtjs.org/options
  */
  axios: {
    // proxy: true,
    headers: process.env.NODE_ENV === 'development' ? {
      common: {
        "Access-Control-Allow-Origin": '*',
        "Access-Control-Expose-Headers": 'X-Debug-Token,X-Debug-Token-Link,Symfony-Debug-Toolbar-Replace'
        //"Access-Control-Expose-Headers": 'X-Debug-Token,X-Debug-Token-Link,Symfony-Debug-Toolbar-Replace'

      }
    } : {},
    baseURL: process.env.NODE_ENV === 'production' ? process.env.PROD_HOST : process.env.DEV_HOST
    // baseURL: process.env.NODE_ENV === 'production' ? 'http://zamniej.loc/' : 'http://zamniej.loc/'
  }
}
