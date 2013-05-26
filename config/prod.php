<?php

require __DIR__.'/app.php';

$app['cache.path'] = __DIR__ . '/../cache';
$app['http_cache.cache_dir'] = $app['cache.path'] . '/http';

$app['twig.options.cache'] = $app['cache.path'] . '/twig';
$app['twig.options.templates'] = __DIR__  .'/../themes/'.$app['theme'] . '/templates';


$app['assetic.cache'] = $app['cache.path'] . '/assetic' ;
$app['assetic.path_to_web'] = __DIR__ . '/../web';
$app['assetic.input.assets'] = __DIR__ . '/../assets';


/**
 * Twitter Bootstrap
 */

$app['assetic.input.bootstrap_css'] = array(
    __DIR__.'/../vendor/twitter/bootstrap/less/bootstrap.less',
    __DIR__.'/../vendor/twitter/bootstrap/less/responsive.less',
);

$app['assetic.input.bootstrap_js'] = array(
    __DIR__.'/../vendor/twitter/bootstrap/js/bootstrap-tooltip.js',
    __DIR__.'/../vendor/twitter/bootstrap/js/*.js',
);


/**
 * Theme
 */

$app['assetic.input.theme_css'] = array(
    __DIR__.'/../themes/'.$app['theme'].'/css/global.css',
    __DIR__.'/../themes/'.$app['theme'].'/css/narrow.css',
    __DIR__.'/../themes/'.$app['theme'].'/css/normal.css',
    __DIR__.'/../themes/'.$app['theme'].'/css/wide.css',
);

$app['assetic.input.theme_js'] = array(
    __DIR__.'/../themes/'.$app['theme'].'/js/angular.js',
    __DIR__.'/../themes/'.$app['theme'].'/js/main.js',
);


/**
 * Output
 */

$app['assetic.output.bootstrap_css'] = 'css/tb.css';
$app['assetic.output.bootstrap_js'] = 'js/tb.js';

$app['assetic.output.theme_css'] = 'css/main.css';
$app['assetic.output.theme_js'] = 'js/main.js';