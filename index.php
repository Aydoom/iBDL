<?php 
header('Content-Type: text/html; charset=utf8');

if ($_SERVER['SERVER_NAME'] === "localhost") {
    define ("HOME", "/iBDL");
} else {
    define ("HOME", "/Nanolek/ibdl");
}

require_once "config/bootstrap.php";

// create tables into mysql
require VENDOR . "php-mysql-migration/index.php";

// connect Auth
require VENDOR . "php-auth/index.php";

// run APP
require APP . "index.php";
