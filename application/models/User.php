<?php

namespace Application\Models;

use Application\Core\Model;

use PDO;

class User extends Model
{
    protected $table = 'users';

    public function checkUser($params)
    {
        $route = 'tasks';

        $query = $this->findUserByLogin($params['login']);

        if ($query->rowCount()) {
            $user = $query->fetch(PDO::FETCH_ASSOC);

            if (password_verify($params['password'], $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
            } else {
                $route = '';
                $invPass = true;
            }
        } else {
            $this->createUser($params);

            $_SESSION['user_id'] = $this->db->lastInsertId();
        }

        return ['message' => $invPass ?? false, 'route' => $route];
    }

    public function createUser($params)
    {
        $params['password'] = password_hash($params['password'], PASSWORD_DEFAULT);

        $addUserQuery = $this->db->prepare("INSERT INTO $this->table (login, password) VALUES (:login, :password)");
        $addUserQuery->execute($params);
    }

    public function findUserByLogin($login)
    {
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE login = :login");
        $query->execute(['login' => $login]);

        return $query;
    }
}