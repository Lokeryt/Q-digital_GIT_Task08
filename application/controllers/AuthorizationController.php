<?php

namespace Application\Controllers;

use Application\Core\Controller;

use Application\Models\User;

class AuthorizationController extends Controller
{
    const PATH = 'auth/auth';

    public function index()
    {
        $message = $this->flash();

        $this->view->path = self::PATH;
        $this->view->render(['message' => $message]);
    }

    public function login()
    {
        if (!isset($_POST['auth'])) {
            $this->flash('Error');
            $this->view->redirect();
            exit;
        }

        if (empty($_POST['login']) || empty($_POST['password'])) {
            $this->flash('Fill login and password');
            $this->view->redirect();
            exit;
        }

        $params = [
            'login' => $_POST['login'],
            'password' => $_POST['password'],
        ];

        $user = new User();
        $response = $user->checkUser($params);

        if ($response['message']) {
            $this->flash($response['message']);
            $this->view->redirect();
            exit;
        }

        $this->view->redirect('tasks');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);

        $this->view->path = self::PATH;
        $this->view->render();
    }
}