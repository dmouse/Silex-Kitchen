<?php

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use SilexAssetic\AsseticServiceProvider;


$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider(), array(
    'twig.path'    => array($app['twig.options.templates']),
    'twig.options' => array('cache' => __DIR__.'/../cache/twig'),
));

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {

    return $twig;
}));


$app->register(new AsseticServiceProvider(), array(
    'assetic.options' => array(
        'debug' => $app['debug'],
        'auto_dump_assets' => $app['debug'],
    )
));

$app['assetic.filter_manager'] = $app->share(
    $app->extend('assetic.filter_manager', function($fm, $app) {
        $fm->set('lessphp', new Assetic\Filter\LessphpFilter());
        return $fm;
    })
);

$app['assetic.asset_manager'] = $app->share(
    $app->extend('assetic.asset_manager', function($am, $app) {

    	/**
    	 * Twitter Boostrap
    	 */

        $am->set('bootstrap_css', new Assetic\Asset\AssetCache(
            new Assetic\Asset\GlobAsset(
                $app['assetic.input.bootstrap_css'],
                array($app['assetic.filter_manager']->get('lessphp'))
            ),
            new Assetic\Cache\FilesystemCache($app['assetic.cache'])
        ));

        $am->set('bootstrap_js', new Assetic\Asset\AssetCache(
            new Assetic\Asset\GlobAsset($app['assetic.input.bootstrap_js']),
            new Assetic\Cache\FilesystemCache($app['assetic.cache'])
        ));

        /**
         * Theme
         */

        $am->set('theme_style', new Assetic\Asset\AssetCache(
            new Assetic\Asset\GlobAsset(
                $app['assetic.input.theme_css']
            ),
            new Assetic\Cache\FilesystemCache($app['assetic.cache'])
        ));
        $am->set('theme_js', new Assetic\Asset\AssetCache(
            new Assetic\Asset\GlobAsset($app['assetic.input.theme_js']),
            new Assetic\Cache\FilesystemCache($app['assetic.cache'])
        ));
        

        /**
         * Get assets
         */

        $am->get('bootstrap_css')->setTargetPath($app['assetic.output.bootstrap_css']);
        $am->get('bootstrap_js')->setTargetPath($app['assetic.output.bootstrap_js']);
        $am->get('theme_style')->setTargetPath($app['assetic.output.theme_css']);
        $am->get('theme_js')->setTargetPath($app['assetic.output.theme_js']);

        return $am;
    })
);