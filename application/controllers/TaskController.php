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
        $message = $this->flash();

        $tasks = new Task();
        $tasks = $tasks->getTasks($_SESSION['user_id']);

        $this->view->path = self::PATH;
        $this->view->render(['tasks' => $tasks ?? [], 'message' => $message]);
    }

    public function store()
    {
        if (!isset($_POST['create'])) {
            $this->flash('Error');
            $this->view->redirect();
            die();
        }

        if (empty($_POST['description'])) {
            $this->flash('Fill task description');
            $this->view->redirect();
            die();
        }

        $params = [
            'user_id' => $_SESSION['user_id'],
            'description' => $_POST['description'],
        ];

        (new Task())->createTask($params);
        $this->view->redirect(self::ROUTE);
    }

    public function delete()
    {
        $task = $this->checkTask($this->route['id']);

        (new Task())->deleteTask($task['id']);
        $this->view->redirect(self::ROUTE);
    }

    public function changeStatus()
    {
        $task = $this->checkTask($this->route['id']);

        (new Task())->changeTaskStatus($task);
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

    private function checkTask($taskId)
    {
        $task = (new Task())->findTaskById($taskId);

        if (!$task) {
            $this->flash('Task not exist');
            $this->view->redirect();
            die();
        }

        if ($task['user_id'] != $_SESSION['user_id']) {
            $this->flash('No access');
            $this->view->redirect();
            die();
        }

        return $task;
    }
}