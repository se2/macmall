# TTG-WP Theme

This is Technology Therapy Group's base WordPress Theme, based on the [\_s (underscores)](https://github.com/automattic/_s) starter theme. We've used various solutions in the past, from [Roots' Sage](https://github.com/roots/sage) to the [HTML5 Blank Theme](http://html5blank.com/) and found this present solution to have the best balance of _simplicity & fleibility_. We do not use child themes very often—instead, simply clone a new copy of this theme into your project and get started.

## Building Sass and JavaScript

TTH-WP Theme includes [Laravel Mix](https://github.com/JeffreyWay/laravel-mix) to compile assets. This way you can write .scss files for CSS and modern JavaScript broken into different files that will be be built for production. Laravel Mix is a library that _just uses webpack_ under the hood, so while it has a simple API is is very powerful.

All you need to do to get building is:

1. Make sure you are in the theme directory: `cd mysite/wp-content/themes/ttg-wp`
2. Run `npm install`
3. Look in the `mix.config.js` file, add your local install's correct URL.
4. Now just run one of our build tasks and you're good to go! Here are the choices:
   1. `npm run dev` Builds the app once, without minifying assets
   2. `npm run watch` Builds the app and watches your scss, php, and js files for changes (use this the most!)
   3. `npm run production` Builds the app for production
