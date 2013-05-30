<?php

use Symfony\Component\ClassLoader\DebugClassLoader;
use Symfony\Component\HttpKernel\Debug\ErrorHandler;
use Symfony\Component\HttpKernel\Debug\ExceptionHandler;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;

ini_set('display_errors', -1);

require_once __DIR__.'/../vendor/autoload.php';

$env = 'prod';
require __DIR__.'/../src/app.php';

$app->run();
