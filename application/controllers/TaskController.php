<?php

namespace Application\Controllers;

use Application\Core\Controller;

use Application\Models\Task;

class TaskController extends Controller
{
    const PATH = 'tasks/tasks';
    const ROUTE = 'tasks';

    public function index()
    {
        $tasks = new Task();
        $tasks = $tasks->getTasks($_SESSION['user_id']);

        $this->view->path = self::PATH;
        $this->view->render(['tasks' => $tasks ?? []]);
    }

    public function store()
    {
        $params = [
            'user_id' => $_SESSION['user_id'],
            'description' => $_POST['description'],
        ];

        (new Task())->createTask($params);
        $this->view->redirect(self::ROUTE);
    }

    public function delete()
    {
        (new Task())->deleteTask($this->route['id']);
        $this->view->redirect(self::ROUTE);
    }

    public function changeStatus()
    {
        (new Task())->changeTaskStatus($this->route['id']);
        $this->view->redirect(self::ROUTE);
    }

    public function readyAll()
    {
        (new Task())->readyAllTasks($_SESSION['user_id']);
        $this->view->redirect(self::ROUTE);
    }

    public function deleteAll()
    {
        (new Task())->deleteAllTasks($_SESSION['user_id']);
        $this->view->redirect(self::ROUTE);
    }
}