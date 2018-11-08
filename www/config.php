<?php

spl_autoload_register(function ($class) {
//    var_dump($class);

    if(file_exists(dirname(__FILE__) . "/$class.php"))
        require_once dirname(__FILE__) . "/$class.php";

    if(file_exists(dirname(__FILE__) . "/class/$class.php"))
        require_once dirname(__FILE__) . "/class/$class.php";

    if(file_exists(dirname(__FILE__) . "/controllers/$class.php"))
        require_once dirname(__FILE__) . "/controllers/$class.php";

    if(file_exists(dirname(__FILE__) . "/controllers/currences/$class.php"))
        require_once dirname(__FILE__) . "/controllers/currences/$class.php";
    if(file_exists(dirname(__FILE__) . "/controllers/currences/sites/$class.php"))
        require_once dirname(__FILE__) . "/controllers/currences/sites/$class.php";
});

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

date_default_timezone_set('Europe/Kiev');

//session_start();

set_error_handler("MyErro");
function MyErro($no, $msg, $file, $line){
    $dt = date('d-m-Y H:i:s');
    $str = "[$dt] - $msg in $file:$line\n";
//    switch ($no) {
//        case E_USER_ERROR:
//        case E_USER_WARNING:
//        case E_USER_NOTICE:
//            echo $msg;
//    }
    error_log("$str", 3, "./error.log");
}

define('APP_BASE_PATH',dirname(__FILE__));


//require_once APP_BASE_PATH . '/App.php';
//require_once APP_BASE_PATH . '/class/ErroeNer.php';
//require_once APP_BASE_PATH . '/class/Controller.php';
//require_once APP_BASE_PATH . '/controllers/SiteController.php';
//require_once APP_BASE_PATH . '/class/Routing.php';
//require_once APP_BASE_PATH . '/class/Request.php';
//require_once APP_BASE_PATH . '/class/Session.php';

require APP_BASE_PATH .'/Model/ActiveRecord.php';


$config = [
        'name' => 'Test_app',
        'basePath' => APP_BASE_PATH
    ];