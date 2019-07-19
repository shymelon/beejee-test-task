<?php

require_once 'autoload.php';

spl_autoload_register('autoload');
session_start();

if(!isset($_SESSION['isAdmin']))
{
    $_SESSION['isAdmin'] = 0;
}

$path = explode('/',$_SERVER['REQUEST_URI']);

$route = new MVC\Router\Router($path);
$route->parse();