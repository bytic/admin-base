// "use strict";

const path = require('path');
var Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}


Encore
    // directory where compiled assets will be stored
    .setOutputPath('dist')
    // public path used by the web server to access the output path
    .setPublicPath('/dist')
    .addEntry(
        'bootstrap3/app',
        ["./src/themes/bootstrap3/assets/scripts/common.js", "./src/themes/bootstrap3/assets/sass/admin.scss"]
    )
    .addEntry(
        'bootstrap4/app',
        ["./src/themes/bootstrap4/assets/scripts/admin.js", "./src/themes/bootstrap4/assets/sass/admin.scss"]
    )

    .cleanupOutputBeforeBuild()
    // .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())

    // enables hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    // enables Sass/SCSS support
    .enableSassLoader((options) => {
        options.sourceMap = true;
        options.sassOptions = {
            outputStyle: 'compressed',
            sourceComments: !Encore.isProduction(),
        };
    }, {})
    .enableLessLoader()

    // uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()

    .disableSingleRuntimeChunk()
;

var config = Encore.getWebpackConfig();

// webpack.config.js
module.exports = config;
