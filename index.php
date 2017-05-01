<?php 

if ($_SERVER['SERVER_NAME'] === "localhost") {
    define ("HOME", "/iBDL");
} else {
    define ("HOME", "/Nanolek/ibdl");
}

require_once "config/bootstrap.php";

require APP . "index.php";