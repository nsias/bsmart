<?php

/**
 * Created by PhpStorm.
 * User: siasn
 * Date: 03-02-17
 * Time: 13:33
 */
class Session
{

    public static function _instance()
    {
        if(!isset($_SESSION['id']))
        {
            session_start();
            $_SESSION["id"] = 0;
            $_SESSION["name"] = "Anonyme";
            $_SESSION["role"] = 0;
            $_SESSION["paid"] = null;
        }
    }

    public static function _destroy()
    {
        if(!isset($_SESSION["id"]))
        {
            unset($_SESSION["id"]);
            unset($_SESSION["name"]);
            unset($_SESSION["role"]);
            unset($_SESSION["paid"]);
            session_destroy();
        }
    }

    public static function getId()
    {
        return $_SESSION["id"];
    }

}

