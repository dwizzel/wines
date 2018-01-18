<?php
/*
@auth: dwizzel
@date: 17-01-2018
@info: basic define file for path and constatn all around the globe
*/

//basic define
define('VERSION', '1.0.0');
define('ENV', 'prod');

//path and directories
define('BASE_PATH', realpath(dirname(__FILE__)));
define('APP_PATH', BASE_PATH.'/../app/');
define('CORE_PATH', BASE_PATH.'/../core/');

//relative path
define('WEB_PATH', '/');
define('JS_PATH', WEB_PATH.'js/');
define('CSS_PATH', WEB_PATH.'css/');

//MVC
define('CONTROLLER_PATH', APP_PATH.'controller/');
define('MODEL_PATH', APP_PATH.'model/');
define('VIEW_PATH', APP_PATH.'view/');

//database connection
if(ENV == 'prod'){
    //report error or not
    error_reporting(0);
    define('DB_DATABASE', '');
    define('DB_HOSTNAME', '');
    define('DB_PORT', '');
    define('DB_USERNAME', '');
    define('DB_PASSWORD', '');
    define('DB_PREFIX', '');
}else{
    error_reporting(E_ALL);
    define('DB_DATABASE', '');
    define('DB_HOSTNAME', '');
    define('DB_PORT', '');
    define('DB_USERNAME', '');
    define('DB_PASSWORD', '');
    define('DB_PREFIX', '');
}

//money display
setlocale(LC_MONETARY, 'en_US');

//END SCRIPT