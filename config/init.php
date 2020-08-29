<?php
/**
 *
 */

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("APP", ROOT . '/app');
define("VENDOR", ROOT . '/vendor/');
define("CORE", ROOT . '/vendor/ishop/core');
define("LIBS", ROOT . '/vendor/ishop/core/libs');
define("CACHE", ROOT . '/tmp/cache');
define("CONF", ROOT . '/config');
define("LAYOUT", 'trans');

// path to file script, example (http://shop.loc/public/index.php)
$app_path = "https://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
// cut name file script, example (http://shop.loc/public/)
$app_path = preg_replace("#[^/]+$#", '',$app_path);
// cut name dir script, get site url
$app_path = str_replace('/public/','',$app_path);
define("PATH", $app_path);

define("ADMIN", '/admin');

require_once ROOT . '/vendor/autoload.php';