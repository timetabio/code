import babel from 'rollup-plugin-babel'
import uglify from 'rollup-plugin-uglify'

const isProduction = process.env[ 'TTIO_BUILD_ENV' ] === 'production'
const plugins = [ babel() ]

if (isProduction) {
  plugins.push(uglify())
}

export default {
  plugins: plugins,
  sourceMap: !isProduction,
  format: 'iife'
}
