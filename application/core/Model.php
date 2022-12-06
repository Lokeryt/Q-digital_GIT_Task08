<?php

namespace Application\Core;

use Config\Db;

class Model
{
    protected $table;

    public $db;

    public function __construct()
    {
        $db = new Db();
        $this->db = $db->connectDb();
    }
}