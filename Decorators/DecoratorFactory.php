<?php
namespace MVC\Decorators;

abstract class DecoratorFactory
{
    public static function create($className,$model)
    {
        $className = 'MVC\\Decorators\\' . ucfirst($className) . 'Decorator';
        return new $className($model);

    }

    abstract public function title();
    abstract public function body();
}