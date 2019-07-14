<?php
namespace MVC\Models;

use PDO;

abstract class AbstractModel
{
    protected $db;

    public function __construct()
    {
        $configuration = parse_ini_file(dirname(__FILE__).'/../dbconfig.ini');
        $this -> db = new PDO(
            $configuration['dsn'],
            $configuration['user'],
            $configuration['password'],
            $configuration['options']);
    }

    abstract function getData();
}