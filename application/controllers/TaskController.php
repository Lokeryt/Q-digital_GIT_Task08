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
        $this->checkParametersExist($_POST, ['create'], 'Error');
        $this->checkParametersExist($_POST, ['description'], 'Fill task description');

        $params = [
            'user_id' => $_SESSION['user_id'],
            'description' => $_POST['description'],
        ];

        (new Task())->createTask($params);
        $this->view->redirect();
    }

    public function delete()
    {
        $task = $this->checkTask($this->route['id']);

        (new Task())->deleteTask($task['id']);
        $this->view->redirect();
    }

    public function changeStatus()
    {
        $task = $this->checkTask($this->route['id']);

        (new Task())->changeTaskStatus($task);
        $this->view->redirect();
    }

    public function readyAll()
    {
        (new Task())->readyAllTasks($_SESSION['user_id']);
        $this->view->redirect();
    }

    public function deleteAll()
    {
        (new Task())->deleteAllTasks($_SESSION['user_id']);
        $this->view->redirect();
    }

    private function checkTask($taskId)
    {
        $task = (new Task())->findTaskById($taskId);

        if (!$task) {
            $this->redirectWithError('Task not exist');
        }

        if ($task['user_id'] != $_SESSION['user_id']) {
            $this->redirectWithError('No access');
        }

        return $task;
    }
}