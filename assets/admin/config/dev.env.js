'use strict'
const merge = require('webpack-merge')
const prodEnv = require('./prod.env')
require('dotenv').config();

module.exports = merge(prodEnv, {
  NODE_ENV: '"development"',
  VUE_APP_HTTPLOCALE: '"' + process.env.VUE_APP_HTTPLOCALE +'"'

})
