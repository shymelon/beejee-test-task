<?php
namespace MVC\Views;

abstract class ViewFactory
{
    abstract public function render();


    public static function create($class, $decorator)
    {
        $class =  'MVC\\Views\\' . ucfirst($class).'View';
        $object = new $class($decorator);
        return $object;
    }
}