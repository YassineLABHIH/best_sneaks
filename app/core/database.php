<?php

class Database
{
    public static $con;

    public function __construct()
    {
        try {
            self::$con = new PDO(DB_TYPE. ":host=" .DB_HOST. ";dbname=" .DB_NAME,DB_USER,DB_PASS);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }

    public static function getInstance()
    {
        if(self::$con){
            return self::$con;

        }
        $a = new self;
        return self::$con;
    }

}

$db = Database::getInstance();