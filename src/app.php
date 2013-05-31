<?php

use Silex\Provider\FormServiceProvider;
use Silex\Provider\TwigServiceProvider;
use SilexAssetic\AsseticServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Symfony\Component\HttpFoundation\Response;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Nutwerk\Provider\DoctrineORMServiceProvider;
use Nuup\Silex\Provider\MongoDBServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;

/**
 * Create Silex Application
 */
$app = new Silex\Application();

/**
 * Register services
 */
$app->register(new DoctrineServiceProvider(), array('db.options' => array(
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'dbname'   => 'walker',
    'user'     => 'root',
    'password' => '',)));
$app->register(new ServiceControllerServiceProvider());
$app->register(new UrlGeneratorServiceProvider());
$app->register(new TranslationServiceProvider());
$app->register(new DoctrineORMServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new SecurityServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new AsseticServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new MongoDBServiceProvider(), array(
    'doctrine.odm.mongodb.connection_options' => array(
        'database' => 'test',
        'host'     => '127.0.0.1',
        'port'     => '27017',
    ),
    'doctrine.odm.mongodb.documents' => array(
        0 => array(
            'type' => 'annotation',
            'path' => array(
                'src',
            ),
            'namespace' => 'Nuup'
        ),
    ),));

/**
 * Load configurations
 */

require_once __DIR__ . '/../config/' . $env .'.php';

/**
 * Routes
 */

$app->mount('/', new Nuup\Controller\Backend($app));


/**
 * Errors
 */

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }
    $page = 404 == $code ? '404.html.twig' : '500.html.twig';
    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});