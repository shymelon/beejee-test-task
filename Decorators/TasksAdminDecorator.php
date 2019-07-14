<?php


namespace MVC\Decorators;


class TasksAdminDecorator extends DecoratorFactory
{
    public $tasks;

    public function __construct($tasks)
    {
        $this->tasks = $tasks;
    }

    public function title()
    {
        return 'Администрирование задач';
    }

    public function navbar()
    {
        return '
        <nav class="navbar navbar-light bg-light justify-content-between">
                <a class="navbar-brand">Задачи</a>
                <a class="btn btn-primary" href="tasks/logout">Выйти</a>
        </nav>';
    }

    private function tableHeaderRender()
    {
        return "<thead>
                <tr>
                    <th>{$this->tasks->isDone}</th>
                    <th>{$this->tasks->username}</th>
                    <th>{$this->tasks->email}</th>
                    <th>{$this->tasks->description}</th>
                    <th></th>
                </tr>
                </thead>";
    }

    private function rowRender($row)
    {
        $isChecked = $row['isDone'] ? "checked" : "";
        return "<tr>
                <form method='post' action='tasks/updateTask'>
                <input type='hidden' name='rowId' value='{$row['id']}'>
                    <td><input type='checkbox' name='isDone' $isChecked value='1' ></td>
                    <td>{$row['username']}</td>
                    <td>{$row["email"]}</td>
                    <td><input type='text' name='description' class='form-control' value='{$row['description']}'></td>
                    <td class='text-center'><input type='submit' class='btn btn-primary' value='Изменить'></td>
                </form>
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