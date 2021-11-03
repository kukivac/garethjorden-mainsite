<?php

use app\router\Router;
use app\models\DbManager;
use app\config\DbConfig;
mb_internal_encoding("UTF-8");

require("../vendor/autoload.php");

/**
 * @param $class
 */
function autoloadFunction($class)
{
    $classname="./../" . str_replace("\\","/",$class) . ".php";
    if (is_readable($classname)) {
        /** @noinspection PhpIncludeInspection */
        require($classname);
    }
}

spl_autoload_register("autoloadFunction");

session_start();

$router = new Router();
$router->process(array($_SERVER['REQUEST_URI']));