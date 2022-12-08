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
        $this->checkParametersExist($_POST, ['auth'], 'Error');
        $this->checkParametersExist($_POST, ['login', 'password'], 'Fill login and password');

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