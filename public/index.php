<?php

use ishop\App;
use ishop\Router;

require_once dirname(__DIR__) . '/config/init.php';
require_once LIBS . '/functions.php';
require_once CONF . '/routes.php';

new App();

//debug(App::$app->getProperties());

//throw new Exception('Page not found', 500);

//debug(Router::getRoutes());