<?php
/**
 * Created by PhpStorm.
 * User: siasn
 * Date: 02-02-17
 * Time: 14:23
 */
include_once("model/Content.php");
include_once("model/Formation.php");
include_once("controller/Session.php");

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
            "register" => new Content("Connexion", $this->getFormConnection()),
            "login" => new Content("Inscription", "Inscrivez-vous !"),
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

    public function getFormationContent($title)
    {
        $formation = new Formation($title);
        return $formation->content;

    }




    //Login stuff


    public function getFormConnection()
    {
        if(isset($_GET["submit"]))
        {
            if(Session::setSession())
            {
                return "Vous êtes connecté<br/><button type=\"submit\" class=\"btn btn-default\" id=\"disconnection\">Déconnexion</button>";
            }
            else
            {
                return "Echec de connexion";
            }
        }
        if(Session::getId() != 0)
        {
            return "Vous êtes connecté<br/><button type=\"submit\" class=\"btn btn-default\" id=\"disconnection\">Déconnexion</button>";
        }
        else
        {
            //<form method ="post" action="testForm.php">
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


}