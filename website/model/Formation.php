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
    public $link;
    public $content;
    public $title;

    public function __construct($link)
    {
        $sql = DBConnection::getInstance();
        $stmt = $sql->prepare("SELECT * FROM formation WHERE nomFormation = ?");
        $stmt->execute(array($link));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result)
        {
            $this->id = $result["0"]["idFormation"];
            $this->content = utf8_encode($result["0"]["theorie"]);
            $this->title = $result["0"]["titre"];
        }
        else
        {
            $this->id = 0;
            $this->title = "Erreur SQL";
            $this->content = "Erreur SQL du contenu";
            $this->link = 'linkError';
        }
    }

    public function getBody()
    {
        if(is_null($this->content))
        {
            return "nope";
        }
        else
            return $this->content;
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