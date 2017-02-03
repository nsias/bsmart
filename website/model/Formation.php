<?php
/**
 * Created by PhpStorm.
 * User: siasn
 * Date: 02-02-17
 * Time: 15:32
 */
include_once("db/ConnectionDB.php");
class Formation {
    public $id;
    public $title;
    public $content;

    public function __construct($title)
    {
        $db_info = new ConnectionDB();
        echo $db_info->server_name;
        echo $db_info->db_name;
        echo $db_info->user;
        echo $db_info->password;
        //$sql = new PDO("mysql: host =localhost; dbname=1516he201220", "SIAS" , "Nicolas6B4g");
        $sql = new PDO("mysql: host =".$db_info->server_name."; dbname=".$db_info->db_name.",".$db_info->user.",".$db_info->password."");
        $stmt = $sql->prepare("SELECT * FROM formation WHERE nomFormation = ?");
        $stmt->execute($title);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result)
        {
            $this->id = $result["0"]["idFormation"];
            $this->content = $result["0"]["theorie"];
        }
        else
        {
            $this->id = 0;
            $this->title = "Erreur SQL";
            $this->content = "Erreur";
        }
    }
}