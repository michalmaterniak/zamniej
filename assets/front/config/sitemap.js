const axios = require('axios')
let baseURLAPI = process.env.NODE_ENV === 'production' ? process.env.PROD_HOST : process.env.DEV_HOST;
let hostName = process.env.NODE_ENV === 'production' ? process.env.BASE_URL : process.env.DEV_HOST;
export default {
  path: '/sitemap.xml',
  hostname: hostName,
  routes: async () => {
    const {data} = await axios.post(`${baseURLAPI}page/api/sitemap`)
    return data.urls.map((url) => url.path)
  },
  defaults: {
    changefreq: 'daily',
    priority: 1,
    lastmod: new Date()
  }
}
