/**
 * This configuration will take our app.scss and app.js files and bundle + minify them for production.
 * It will also give us a link in development and automatically-refresh when we change scss, js, or even php files!
 *
 * Built script and css files are stored in the `/dist` directory and are enqueued in our functions.php file
 */

const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')

mix
  .js('js/app.js', 'dist/app.js')
  .sass('scss/app.scss', 'dist/')
  .options({ processCssUrls: false, postCss: [tailwindcss('./tailwind.js')] })
  .browserSync({
    injectChanges: true,
    proxy: 'http://macmall.dev.cc', // make sure to set http/s correctly!
    files: ['js/{*,**/*}.js', 'scss/{*,**/*}.scss', '{*,**/*}.php'],
  })
