<?php

namespace Application\Models;

use Application\Core\Model;

use Application\Models\User;

use PDO;

class Task extends Model
{
    protected $table = 'tasks';

    public function getTasks($userId)
    {
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE user_id = :user_id ORDER BY id");
        $query->execute(['user_id' => $userId]);
        $tasks = $query->fetchAll(PDO::FETCH_ASSOC);

        return $tasks;
    }

    public function createTask($params)
    {
        $query = $this->db->prepare("INSERT INTO $this->table (user_id, description) VALUES (:user_id, :description)");
        $query->execute($params);
    }

    public function deleteTask($id)
    {
        $query = $this->db->prepare("DELETE FROM $this->table WHERE id = :id");
        $query->execute(['id' => $id]);
    }

    public function changeTaskStatus($id)
    {
        $task = $this->findTaskById($id);

        $status = $task['status'] ? 0 : 1;

        $query = $this->db->prepare("UPDATE $this->table SET status = :status WHERE id = :id");
        $query->execute(['id' => $id, 'status' => $status]);
    }

    public function readyAllTasks($userId)
    {
        $changeStatusQuery = $this->db->prepare("UPDATE $this->table SET status = TRUE WHERE user_id = :user_id");
        $changeStatusQuery->execute(['user_id' => $userId]);
    }

    public function deleteAllTasks($userId)
    {
        $query = $this->db->prepare("DELETE FROM $this->table WHERE user_id = :user_id");
        $query->execute(['user_id' => $userId]);
    }

    public function findTaskById($id)
    {
        $query = $this->db->prepare("SELECT status FROM $this->table WHERE id = :id");
        $query->execute(['id' => $id]);
        $task = $query->fetch(PDO::FETCH_ASSOC);

        return $task;
    }
}