<?php

//website name
define("WEBSITE_TITLE", 'Best sneaks');

//database name
define('DB_NAME', "bestsneaks_db");
define('DB_USER', "root");
define('DB_PASS', "");


//define debug mode
define('DEBUG', true);

if(DEBUG){
    ini_set('display_errors', 1);
}else{
    ini_set('display_errors', 0);
}

