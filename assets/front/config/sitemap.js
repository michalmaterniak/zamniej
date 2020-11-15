const axios = require('axios')

export default [
  {
    path: '/sitemap-products.xml',
    routes: [
      // array of URL
    ]
  },
  {
    path: '/sitemap-news.xml',
    routes: async () => {
      const {data} = await axios.get('https://jsonplaceholder.typicode.com/users')
      return data.map((user) => `/users/${user.username}`)
    }
  },
  {
    path: '/sitemapindex.xml',
    sitemaps: [
      {
        // array of Sitemap configuration
      }
    ]
  }
]
