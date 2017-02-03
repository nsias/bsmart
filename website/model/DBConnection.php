<?php

/**
 * Created by PhpStorm.
 * User: siasn
 * Date: 03-02-17
 * Time: 13:35
 */
class DBConnection
{
    /**
     * @var PDO
     */
    private static $connection = null;

    /**
     * Private constructor (singleton pattern)
     */
    private function __construct()
    {
        //$sql = new PDO("mysql:host=".$db_info->server_name.";dbname=".$db_info->db_name.",".$db_info->user.",".$db_info->password);
        //self::$connection = new PDO("mysql:host=localhost;dbname=mydb","root","");
    }

    /**
     * @return DBConnection|PDO
     */
    public static function getInstance()
    {
        if (is_null(self::$connection))
        {
            self::$connection = new PDO("mysql:host=localhost;dbname=mydb","root","");
        }

        return self::$connection;
    }
}


