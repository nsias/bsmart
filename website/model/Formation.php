<?php
/**
 * Created by PhpStorm.
 * User: siasn
 * Date: 02-02-17
 * Time: 15:32
 */
include_once("model/DBConnection.php");
class Formation {
    public $id;
    public $title;
    public $content;

    public function __construct($title)
    {
        $sql = DBConnection::getInstance();
        //$sql = new PDO("mysql: host =localhost; dbname=1516he201220", "SIAS" , "Nicolas6B4g");
        //$sql = new PDO("mysql:host=".$db_info->server_name.";dbname=".$db_info->db_name.",".$db_info->user.",".$db_info->password);

        $stmt = $sql->prepare("SELECT * FROM formation WHERE nomFormation = ?");
        $stmt->execute(array($title));
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
            $this->content = "Erreur SQL du contenu";
        }
    }
}


/*
 *                 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Formations<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="english">Anglais</a></li>
                        <li><a href="php">Php</a></li>
                        <li><a href="security">Sécurité des réseaux</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="allFormations">Toutes les formations</a></li>
                    </ul>
                </li>
                <li><a href="evaluation">Vos évaluations</a></li>
                <li><a href="register"><span class="glyphicon glyphicon-user"></span>S'enregistrer</a></li>
                <li><a href="login"><span class="glyphicon glyphicon-log-in"></span>Se connecter</a></li>
 */