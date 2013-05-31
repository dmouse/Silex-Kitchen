<?php

$app['theme'] = 'basic';

$app['cache.path'] = __DIR__ . '/../cache';
$app['http_cache.cache_dir'] = $app['cache.path'] . '/http';

$app['twig.options.cache'] = $app['cache.path'] . '/twig';
$app['twig.options.templates'] = __DIR__  .'/../themes/'.$app['theme'] . '/templates';

$app['twig.path'] = array($app['twig.options.templates']);
$app['twig.options'] = array('cache' => $app['twig.options.cache']);

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
 * Output Assetics files
 */

$app['assetic.output.bootstrap_css'] = 'css/tb.css';
$app['assetic.output.bootstrap_js'] = 'js/tb.js';

$app['assetic.output.theme_css'] = 'css/main.css';
$app['assetic.output.theme_js'] = 'js/main.js';

/**
 * DB
 */

$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'dbname'   => 'walker',
    'user'     => 'root',
    'password' => '',
);

/**
 * Assetics Provider configuration 
 */

$app['assetic.options'] = array(
    'debug' => $app['debug'],
    'auto_dump_assets' => $app['debug'],
);

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


/**
 * Doctrin ORM config
 */

$app['db.orm.proxies_dir']           = __DIR__ . '../cache/doctrine/proxy';
$app['db.orm.proxies_namespace']     = 'DoctrineProxy';
$app['db.orm.auto_generate_proxies'] = true;
$app['db.orm.entities']              = array(
    array(
        'type'      => 'annotation',       // entity definition 
        'path'      => __DIR__ ,   // path to your entity classes
        'namespace' => 'Nuup\Entity', // your classes namespace
    )
);

/**
 * Firewall 
 */
$app['security.firewalls'] = array(
    'admin' => array(
        'pattern' => '^/',
        'form'    => array(
            'login_path'         => '/login',
            'username_parameter' => 'form[username]',
            'password_parameter' => 'form[password]',
        ),
        'logout'    => true,
        'anonymous' => true,
        'users'     => $app->share(function () use ($app) {
            return new Nuup\Controller\UserProvider($app['db']);
        }),
    ),
);