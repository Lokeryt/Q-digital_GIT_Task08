<?php

namespace Config;

use PDO;

class Db
{
    const DB_HOST = 'localhost';
    const DB_NAME = 'tasklist';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = 'root';
    const DB_TABLE_VERSIONS = 'versions';

    public $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME, self::DB_USERNAME, self::DB_PASSWORD);
    }

    public function connectDb()
    {
        return $this->db;
    }
}