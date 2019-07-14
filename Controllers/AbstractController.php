<?php
namespace MVC\Controllers;


abstract class AbstractController
{
    public $model;
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
        $modelClass = 'MVC\\Models\\'.$name.'Model';
        $this->model = new $modelClass;
    }

    public function render()
    {
        $decorator = \MVC\Decorators\DecoratorFactory::create($this->name, $this->model);
        $view = \MVC\Views\ViewFactory::create($this->name, $decorator);
        return $view->render();
    }
}