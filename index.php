<?php

$startTime = new DateTime();

define('RUN_MODE', $_SERVER['RUN_MODE'], true);//set RUN_MODE with case sensitivity

//in debug we want to see all type of errors
if (RUN_MODE == 'production')
    error_reporting(0);
else if (RUN_MODE == 'debug')
    error_reporting(E_ALL);
else if (RUN_MODE == 'development')
    error_reporting(E_ALL | E_STRICT);
else
    error_reporting(0);

//define directory separator
define('DS', DIRECTORY_SEPARATOR, true);
//file separator, used to beautify paths to replace \\' to . FS, good for auto includes(spl)
define('FS', '\\', true);

//basic project configurations
define('APP_PATH', './private/app', true);
define('CORE_PATH', APP_PATH . DS . 'core', true);
define('COMMON_PATH', APP_PATH . DS . 'common' . DS, true);

//autoload
//based on namespace, autoload will know what to include
//safer than get_include_path() . PATH_SEPARATOR . APP_PATH
set_include_path(implode(PATH_SEPARATOR, array(APP_PATH/*, add here if you want additional include path*/)));

spl_autoload_extensions('.php, Controller.php');
//use default autoload implementation
spl_autoload_register();

//our general registry
$registry = Core\Registry::Instance();

$registry->logger = new Core\Logger(APP_PATH . Common\Config::$logger_dir);
set_error_handler('Core\Logger::ErrorHandler');
//test logging
//trigger_error('est', E_USER_NOTICE);

$registry->router = new Core\Router(isset($registry->get['path']) ? $registry->get['path'] : '');
//set the controller and model name for possible future use
$registry->controllerName = $registry->router->GetController();
$registry->modelName = $registry->router->GetModel();

//handles the case when controller doesn't exists
if (empty($registry->controllerName))
{
    //load default controller/model which defined in some config
    $registry->controllerName = Common\Config::$default_controller;
    $registry->modelName = Common\Config::$default_model;
}

$tmpControllerClassName = 'Controller' . FS . $registry->controllerName;
if (!is_file(APP_PATH . DS . $tmpControllerClassName . '.php'))
{//todo set into config?
    $tmpControllerClassName = 'Core' . FS . \Common\Config::$error_controller;
    $registry->modelName = 'error404';
}

$registry->controller = new $tmpControllerClassName();

if (is_null($registry->modelName))
    $registry->controller->index();
else if(!method_exists($registry->controller, $registry->modelName))
    $registry->controller->error404();
else
    $registry->controller->{$registry->modelName}();

//echo '<pre>';
//var_dump($registry);
//echo '</pre>';
//todo
//$registry->controller->$registry->modelName();
//echo '<pre>';
//$queryString = $_GET['path'];
//
//echo $queryString . PHP_EOL;
//$endTime = new DateTime();
//$timeDiff = $endTime->diff($startTime);
//echo '</pre>';