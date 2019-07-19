<?php

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