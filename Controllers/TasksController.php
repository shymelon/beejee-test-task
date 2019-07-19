<?php


namespace MVC\Controllers;


class TasksController extends AbstractController
{
    private $adminPrefix = "";

    public function postTask()
    {
        $description = $_POST['description'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $this->model->insertData($description, $username, $email);
        header('Location: /');
    }

    public function updateTask()
    {
        $isDone = $_POST['isDone'];
        $description = $_POST['description'];
        $id = $_POST['rowId'];
        $this->model->updateData($id, $description,$isDone);
        header('Location: /');
    }

    public function login(){
        $login = $_POST['login'];
        $password = $_POST['password'];
        $configuration = parse_ini_file(dirname(__FILE__).'/../adminsettings.ini');
        if($login == $configuration['login'] && $password == $configuration['password'])
        {
            $_SESSION['isAdmin'] = 1;
        }
        header('Location: /');
    }

    public function logout()
    {
        $_SESSION['isAdmin'] = 0;
        header('Location: /');
    }

    private function isAdmin()
    {
        if($_SESSION['isAdmin'] == 1)
        {
            $this->adminPrefix = "Admin";
        }
    }

    public function render()
    {
        $this->isAdmin();
        $decorator = \MVC\Decorators\DecoratorFactory::create($this->name.$this->adminPrefix, $this->model);
        $view = \MVC\Views\ViewFactory::create($this->name, $decorator);
        return $view->render();
    }
}
