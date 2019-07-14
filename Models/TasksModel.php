<?php
namespace MVC\Models;

class TasksModel extends AbstractModel
{
    public $username = 'Имя пользователя';
    public $description = 'Описание задачи';
    public $email = 'Почта';
    public $isDone = 'Выполнено';
    public $isModified = 'Отредактировано администратором';


    function getData()
    {
        return $this->db->query('SELECT * FROM tasks')->fetchAll();
    }

    function insertData($description, $username="Anon", $email=null)
    {
        $statement = $this->db->prepare('INSERT INTO tasks (username, email, description) VALUES
                    (?,?,?)');
            return $statement->execute([$username,$email,$description]);
    }

    function updateData($id, $description, $isDone)
    {
        $statement = $this->db->prepare('UPDATE tasks SET description=?, isModified=1, isDone=? WHERE id=?');
        return $statement->execute([$description,$isDone,$id]);
    }
}