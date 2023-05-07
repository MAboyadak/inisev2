<?php

class DB
{
    public static $conn;

    private function __construct(){}
    
    public static function connect()
    {
        if(isset(self::$conn)){
            return self::$conn;
        }
        try{
            self::$conn = new \PDO('mysql:host=91.107.196.153;port=3306;dbname='.DB_NAME, DB_USER, DB_PASS,[
                \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
        }catch(\PDOException $e){
            throw new \PDOException($e->getMessage());
        }

        return self::$conn;
    }
}

?>