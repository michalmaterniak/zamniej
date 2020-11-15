const axios = require('axios')
let baseURL = process.env.NODE_ENV === 'production' ? process.env.PROD_HOST : process.env.DEV_HOST;
export default {
  path: '/sitemap.xml',
    routes: async () => {
      const {data} = await axios.post(`http://apizamniej.loc/page/api/sitemap`)
      return data.urls.map((url) => url.path)
    },
    defaults: {
      changefreq: 'daily',
      priority: 1,
      lastmod: new Date()
    }
}
