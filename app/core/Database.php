<?php

class Database
{
    /*
    *
    * This is the Database class
    */
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
        return $instance = new self;
        
    }

    /*
    *
    * read from database
    */
    public function read($query,$data = array())
    {
        $stm = self::$con->prepare($query);
        $result = $stm->execute($data);

        if($result)
        {
            $data = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($data))
            {
                return $data;

            }
        }

        return false;
    }

     /*
    *
    * write to database
    */
     public function write($query,$data = array())
     {
        $stm = self::$con->prepare($query);
        $result = $stm->execute($data);

        if($result)
        {
        
            return true;
        }

        return false;
     }
}