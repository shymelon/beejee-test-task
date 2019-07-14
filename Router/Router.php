<?php
namespace MVC\Router;

use MVC\Controllers\TasksController;

class Router
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function parse()
    {
        $controllerName = $this->path[2];

        if(isset($this->path[3]))
        {
            $methodName = $this->path[3];
        }

        if(!empty($controllerName))
        {
            $className =  'MVC\\Controllers\\' . ucfirst($controllerName) . 'Controller';
            $controller = new $className($controllerName);
        }
        else
        {
            $controller = new TasksController('Tasks');
        }
        if(!empty($methodName))
        {
            $controller->$methodName();
        }
        echo $controller->render();
    }
}