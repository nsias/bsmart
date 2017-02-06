<?php

/**
 * Created by PhpStorm.
 * User: siasn
 * Date: 03-02-17
 * Time: 13:33
 */
include_once("model/DBConnection.php");

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
    public static function setSession()
    {
        $sql = DBConnection::getInstance();
        $stmt = $sql->prepare("SELECT * FROM user WHERE pseudo = ? and password = ?");
        $stmt->execute(array($_GET['user'],$_GET['pwd']));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result)
        {
            $_SESSION["id"]=$result[0]["iduser"];
            $_SESSION["name"]=$result[0]["pseudo"];
            $_SESSION["role"]=$result[0]["idStatut"];
            return true;
        }
        else
            return false;
    }

}

