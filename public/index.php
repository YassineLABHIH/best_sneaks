<?php
session_start();

$path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
$path = str_replace("index.php", "", $path);

//define the root path
define('ROOT', $path);
//define the assets path
define('ASSETS', $path ."assets/");

include "../app/init.php";

$app = new Router();