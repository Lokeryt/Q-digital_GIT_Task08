<?php

namespace Application\Core;

use Config\Db;

class Model
{
    protected $table;

    public $db;

    public function __construct()
    {
        $this->db = Db::getInstance()->getConnection();
    }
}