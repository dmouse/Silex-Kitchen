<?php

use Symfony\Component\ClassLoader\DebugClassLoader;
use Symfony\Component\HttpKernel\Debug\ErrorHandler;
use Symfony\Component\HttpKernel\Debug\ExceptionHandler;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;


require_once __DIR__.'/../vendor/autoload.php';

error_reporting(-1);
DebugClassLoader::enable();
ErrorHandler::register();
if ('cli' !== php_sapi_name()) {
    ExceptionHandler::register();
}


$env = 'dev';
require __DIR__.'/../src/app.php';

$app->run();
