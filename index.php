<?php

use MVC\Controllers\TasksController;
//ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
function autoload($className){
    $classPieces = explode(DIRECTORY_SEPARATOR,$className);
    if($classPieces[0] == 'MVC')
    {
        $pathToFile =  __DIR__. DIRECTORY_SEPARATOR. implode(DIRECTORY_SEPARATOR,array($classPieces[1],$classPieces[2])). '.php';
        if(!file_exists($pathToFile)){
            die("<h1> 404 not found</h1>");
        }
        require_once $pathToFile;
    }
}
session_start();

if(!isset($_SESSION['isAdmin']))
{
    $_SESSION['isAdmin'] = 0;
}
spl_autoload_register('autoload');
$path = explode('/',$_SERVER['REQUEST_URI']);

$route = new MVC\Router\Router($path);
$route->parse();