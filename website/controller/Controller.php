<?php
/**
 * Created by PhpStorm.
 * User: siasn
 * Date: 02-02-17
 * Time: 14:21
 */
include_once("model/Model.php");

class Controller {
    public $model;
    public $json_data = [];

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke()
    {
        session_start();
        if(isset($_GET['submit']) && $_GET["submit"] == "LOGIN")
        {
            $sql = DBConnection::getInstance();
            $stmt = $sql->prepare("SELECT * FROM user WHERE pseudo = ? and password = ?");
            $stmt->execute(array($_GET['user'],$_GET['pwd']));
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($result)
            {
                $_SESSION["id"]= $result[0]["iduser"];
                $_SESSION["name"]=$result[0]["pseudo"];
                $_SESSION["role"]=$result[0]["idStatut"];
            }
        }

        $role = 0;
        if(isset($_SESSION['role']))
        {
            $role = $_SESSION["role"];
        }
        if (!isset($_GET['content']))
        {
            // no special formations is requested
            $content = $this->model->getContent("main");
            $json_data['menuContent'] = $this->model->getMenuByRole($role);
            $json_data['titleContent'] = $content->title;
            $json_data['bodyContent'] = $content->content;
            include 'view/viewmain.php';
        }
        else
        {
            // show the requested content
            $content = $this->model->getContent($_GET["content"]);
            $json_data['menuContent'] = $this->model->getMenuByRole($role);
            $json_data['titleContent'] = $content->title;
            $json_data['bodyContent'] = $content->content;
            //$json_data['bodyContent'] .= "<br/>".implode("\n",$_SESSION);
            //include 'view/viewmain.php';
        }
        die(json_encode($json_data));
    }
}