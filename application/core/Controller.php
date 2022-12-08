<?php

namespace Application\Core;

use Application\Core\View;

class Controller
{
    public $route;
    public $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->checkAuth();
    }

    public function isAuth()
    {
        return $_SESSION['user_id'] ?? false;
    }

    public function checkAuth()
    {
        $isAuth = $this->isAuth();

        if ($this->route['auth'] == 'authorize' && !$isAuth) {
            View::errorCode(403);
        } elseif ($this->route['auth'] == 'not_authorize' && $isAuth) {
            $this->view->redirect('tasks');
        }
    }

    public function flash(string $message = null)
    {
        if ($message) {
            $_SESSION['flash'] = $message;
        } else {
            if (!empty($_SESSION['flash'])) {
                $message = $_SESSION['flash'];
            }

            unset($_SESSION['flash']);
        }

        return $message;
    }

    public function checkParametersExist(array $variable, array $parameters, string $message, $url = '')
    {
        foreach ($parameters as $parameter) {
            if (empty($variable[$parameter])) {
                $this->redirectWithError($message, $url);
            }
        }
    }

    public function redirectWithError($message, $url = '')
    {
        $this->flash($message);
        $this->view->redirect($url);
        exit;
    }
}