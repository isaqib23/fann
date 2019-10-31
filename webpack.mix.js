let mix = require('laravel-mix');
const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');

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


/*Mix.listen('configReady', config => {
    const sassRule = config.module.rules.find(r => r.test.toString() === /\.sass$/.toString())
    const sassOptions = sassRule.loaders.find(l => l.loader === 'sass-loader').options
    sassOptions.data = '@import "./resources/assets/sass/imports.scss"'
})*/

mix
    .options({
        extractVueStyles: true
    })
    .webpackConfig({
        'plugins': [
            new VuetifyLoaderPlugin()
        ]
    });

if (mix.inProduction()) {
    mix.options({
        uglify: {
            parallel: true
        }
    });
}

mix.js('resources/js/app.js', 'public/js')
   .extract(['vue', 'vue-router', 'vuex', 'axios'])
   .sass('resources/styles/app.sass', 'public/css')

mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.json', '.vue'],
    alias: {
      '~': path.join(__dirname, './resources/js'),
      '$comp': path.join(__dirname, './resources/js/components')
    }
  }
});

//mix.browserSync(process.env.APP_URL)
