<?php


namespace MVC\Decorators;


class TasksDecorator extends DecoratorFactory
{
    public $tasks;

    public function __construct($tasks)
    {
        $this->tasks = $tasks;
    }

    public function title()
    {
        return 'Задачи';
    }

    public function navbar()
    {
        return '
        <nav class="navbar navbar-light bg-light justify-content-between">
                <a class="navbar-brand">Задачи</a>
                <form class="form-inline" action="tasks/login" method="post">
                <input class="form-control mr-sm-2" type="text" placeholder="Логин" name="login">
                <input class="form-control mr-sm-2" type="password" placeholder="Пароль" name="password">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Войти</button>
            </form>
        </nav>';
    }

    private function tableHeaderRender()
    {
        return "<thead>
                <tr>
                    <th>{$this->tasks->username}</th>
                    <th>{$this->tasks->email}</th>
                    <th>{$this->tasks->description}</th>
                </tr>
                </thead>";
    }

    private function rowRender($row)
    {
        $doneClass = $row['isDone'] ? 'bg-success' : '';
        $modifiedPrefix = $row['isModified'] ? 'отредактировано администратором' : '';
        return "<tr class='{$doneClass}'>
                    <td>{$row['username']}</td>
                    <td>{$row["email"]}</td>
                    <td>{$row["description"]} <span class='badge badge-info'>$modifiedPrefix</span></td>
                </tr>";
    }

    public function body()
    {
        $tableBody = '<table id="tasks" class="table table-striped table-bordered">';
        $tableBody .= $this->tableHeaderRender();
        foreach ($this->tasks->getData() as $task)
        {
            $tableBody .= $this->rowRender($task);
        }
        return $tableBody . '</table>';
    }
}