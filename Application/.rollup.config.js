import babel from 'rollup-plugin-babel'

const isProduction = process.env[ 'TTIO_BUILD_ENV' ] === 'production'

export default {
  plugins: [ babel() ],
  sourceMap: !isProduction,
  format: 'iife'
}
