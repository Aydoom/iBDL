<?php 
//header('Content-Type: text/html; charset=utf8');

if ($_SERVER['SERVER_NAME'] === "localhost") {
    define ("HOME", "/iBDL");
    define ("LOGPATH", 3);
} else {
    define ("HOME", "/Nanolek/ibdl");
    define ("LOGPATH", 9);
}

require_once "config/bootstrap.php";

// create tables into mysql
require VENDOR . "php-mysql-migration/index.php";

// connect Auth
require VENDOR . "php-auth/index.php";

// run APP
require APP . "index.php";
