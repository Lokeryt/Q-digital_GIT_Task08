<?php

namespace Config;

return [
    '' => [
        'controller' => 'authorization',
        'action' => 'index',
        'auth' => 'not_authorize',
    ],
    'login' => [
        'controller' => 'authorization',
        'action' => 'login',
        'auth' => 'not_authorize',
    ],
    'logout' => [
        'controller' => 'authorization',
        'action' => 'logout',
        'auth' => 'authorize',
    ],
    'tasks' => [
        'controller' => 'task',
        'action' => 'index',
        'auth' => 'authorize',
    ],
    'task/create' => [
        'controller' => 'task',
        'action' => 'store',
        'auth' => 'authorize',
    ],
    'task/delete/{id:\d+}' => [
        'controller' => 'task',
        'action' => 'delete',
        'auth' => 'authorize',
    ],
    'task/ready/{id:\d+}' => [
        'controller' => 'task',
        'action' => 'changeStatus',
        'auth' => 'authorize',
    ],
    'task/ready-all' => [
        'controller' => 'task',
        'action' => 'readyAll',
        'auth' => 'authorize',
    ],
    'task/delete-all' => [
        'controller' => 'task',
        'action' => 'deleteAll',
        'auth' => 'authorize',
    ],
];