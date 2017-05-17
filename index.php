<?php 

if ($_SERVER['SERVER_NAME'] === "localhost") {
    define ("HOME", "/iBDL");
} else {
    define ("HOME", "/Nanolek/ibdl");
}

require_once "config/bootstrap.php";

// create tables into mysql
require VENDOR . "php-mysql-migration/index.php";

// run Auth
require_once APP . "config/auth.php";

// run APP
require APP . "index.php";
