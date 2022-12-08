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

    private static $_instance = null;
    private $db;

    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __construct()
    {
        $this->db = new PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME, self::DB_USERNAME, self::DB_PASSWORD) or die('Connection error');
    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }

    public function getConnection()
    {
        return $this->db;
    }
}