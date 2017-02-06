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
            "main" => new Content("Bienvenue sur Bsmart", "Le meilleur de site de formation en ligne"),
            "english" => new Content("Anglais", $this->getFormationContent("english")), //"D.Verdonck"
            "security" => new Content("Sécurité des réseaux","Ceci est une description de cours"),//"A.Vanham"
            "php" => new Content("PHP", "Ceci est le cours de Delvigne"),
            "evaluation" => new Content("Vos evaluations", "Ceci est la liste des eval"),
            "register" => new Content("Inscription", "Inscrivez-vous !"),
            "login" => new Content("Connexion", $this->getFormConnection()),
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

    //--------------FORMATIONS METHODS -------------//

    public function getFormationContent($title)
    {
        $formation = new Formation($title);
        return $formation->content;

    }
    //--------------MENU METHODS ----------------------//
    public function getMenuByRole($role)
    {
        $array_menu = [];
        switch($role)
        {
            case '0' :
                $array_menu = array (
                    "Inscription" => "register",
                    "Connexion" => "login"
                ); break; //Anonymous
            case '1' :
                $array_menu = array (
                "Formations" => "allFormation",
                "Vos evaluations" => "evaluation",
                "Inscription" => "register",
                "Connexion" => "login"
            ); break; //Student
            case '2' :
                $array_menu = array (
                "Formations" => "allFormation",
                "Corrections" => "correction",
                "Inscription" => "register",
                "Connexion" => "login"
            );break; //Teacher
        }
        return $this->getMenu($array_menu);
    }

    public function getMenu($array)
    {
        $tb = '';
        foreach($array as $key => $value)
        {
            $tb .="<li><a href=\"$value\">".$key."</a></li>";
        }
        return $tb;
    }


    //---------------LOGIN--------------------------//

    public function getFormConnection()
    {
           return "<form id=\"connexion\">
        <div class=\"form-group\">
        <label for=\"text\">Pseudo:</label>
        <input type=\"text\" class=\"form-control\" id=\"user\">
        </div>
        <div class=\"form-group\">
        <label for=\"pwd\">Mot de passe:</label>
        <input type=\"password\" class=\"form-control\" id=\"pwd\">
        </div>
        <button type=\"submit\" href=\"javascript::onclick();\" class=\"btn btn-default\" id=\"loginButton\">Connexion</button>
        </form>";

    }


}