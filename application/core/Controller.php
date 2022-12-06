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
            View::errorCode(403);
        }
    }
}