<?php
/**
 * Created by PhpStorm.
 * User: siasn
 * Date: 02-02-17
 * Time: 14:23
 */
include_once("model/Content.php");
include_once("model/Formation.php");

class Model {

    public function getContentList()
    {
        // here goes some hardcoded values to simulate the database
        return array(
            "main" => new Content("<br/>Bienvenue sur Bsmart", "Le meilleur de site de formation en ligne"),
            "english" => new Content("Anglais", "Ceci est de l'anglais"), //"D.Verdonck"
            "security" => new Content("Sécurité des réseaux","Ceci est une description de cours"),//"A.Vanham"
            "php" => new Content("PHP", "Ceci est le cours de Delvigne"),
            "evaluation" => new Content("Vos evaluations", "Ceci est la liste des eval"),
            "login" => new Content("Connexion", "Connectez-vous !"),
            "register" => new Content("Inscription", "Inscrivez-vous !"),
            "allFormation" => new Content("Toutes les formations", "Ceci est la liste des formations")
        );
    }

    public function getContent($title)
    {
        // we use the previous function to get all the books and then we return the requested one.
        // in the future, this will be done through a db select command
        $allContents = $this->getContentList();
        return $allContents[$title];
    }


}