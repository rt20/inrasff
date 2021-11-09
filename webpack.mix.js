const mix = require('laravel-mix');
const glob = require('glob')
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const sassOptions = {
  precision: 5,
  includePaths: ['node_modules', 'resources/assets/']
}

mix
  .js('resources/js/app.js', 'public/js')
  .postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('postcss-nested'),
    require('autoprefixer'),
  ]);

// mix.postCss('public/backadmin/theme/css/bootstrap.min.css', 'public/css/theme')

function mixAssetsDir(query, cb) {
  ; (glob.sync('resources/' + query) || []).forEach(f => {
    f = f.replace(/[\\\/]+/g, '/')
    cb(f, f.replace('resources', 'public'))
  })
}

mixAssetsDir('vendors/js/**/*.js', (src, dest) => mix.scripts(src, dest))
mixAssetsDir('vendors/css/**/*.css', (src, dest) => mix.copy(src, dest))

mix.sass('resources/sass/core.scss', 'public/css', { sassOptions })

if (mix.inProduction()) {
  mix
    .version();
}
