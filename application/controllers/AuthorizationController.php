<?php

namespace Application\Controllers;

use Application\Core\Controller;

use Application\Models\User;

class AuthorizationController extends Controller
{
    const PATH = 'auth/auth';

    public function index()
    {
        $this->view->path = self::PATH;
        $this->view->render();
    }

    public function login()
    {
        $params = [
            'login' => $_POST['login'],
            'password' => $_POST['password'],
        ];

        $user = new User();
        $response = $user->checkUser($params);

        if ($response['message']) {
            $this->view->redirect();
            exit;
        }

        $this->view->redirect('tasks');
    }

    public function logout()
    {
        $_SESSION['user_id'] = null;

        $this->view->path = self::PATH;
        $this->view->render();
    }
}