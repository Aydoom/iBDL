<?php
session_start();

define ("DS", DIRECTORY_SEPARATOR);

define("ROOT", __DIR__ . DS . ".." . DS);

    define("CONFIG", ROOT . "config" . DS);
    define("CORE", ROOT . "core" . DS);
    define("PLUGINS", ROOT . "plugins" . DS);
    define("VENDOR", ROOT . "vendor" . DS);
    define("APP", ROOT . "app" . DS);	
		define("CONTROLLERS", APP . "controllers" . DS);
		define("MODELS", APP . "models" . DS);
		define("VIEW", APP . "view" . DS);
			define("LAYOUT", VIEW . "layout" . DS);
		define("WEBROOT", HOME . DS . "app" . DS . "webroot" . DS);
			define("CSS", WEBROOT . "css" . DS);
			define("JS", WEBROOT . "js" . DS);
			define("IMGES", WEBROOT . "images" . DS);
			define("FONTS", WEBROOT . "fonts" . DS);
    
require_once CONFIG . "autoloader.php";
require_once CONFIG . "basic.php";

// Include Doctrine 2
// Create a simple "default" Doctrine ORM configuration for Annotations
$config = new Doctrine\ORM\Configuration();

$connectionParams = array(
    'dbname' => 'mydb',
    'user' => 'user',
    'password' => 'secret',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);

$conn = Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);