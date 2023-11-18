const mix = require("laravel-mix");
const publicDir = "./public";

mix
    .js("resources/js/script.js", "assets/js/script.js")
    // .js("resources/js/question.js", "assets/js/script.js")
    .sass("resources/sass/style.scss", "assets/css/")
    .setPublicPath(publicDir)
    .options({
        processCssUrls: false,
        manifest: false,
    })