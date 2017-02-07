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
            "php" => new Content("PHP", $this->getFormationContent("php")),
            "evaluation" => new Content("Vos evaluations", "Ceci est la liste des eval"),
            "register" => new Content("Inscription", $this->getFormRegister()),
            "login" => new Content("Connexion", $this->getFormConnection()),
            "allFormation" => new Content("Toutes les formations", $this->getFormationByUser())
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

    public function getFormationByUser()
    {
        if(!isset($_SESSION["id"]))
            return "Vous n'êtes pas connecté";
        $out = '<h2>Vos formations</h2><div><ul>';
        $sql = DBConnection::getInstance();
        $stmt = $sql->prepare("SELECT idFormation FROM user_formation WHERE idUser = ?");
        $stmt->execute(array($_SESSION["id"]));
        $db_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($db_result)
        {
            foreach($db_result as $r)
            {
                foreach($r as $id_formation)
                {
                    $stmt = $sql->prepare("SELECT * FROM formation WHERE idFormation = ?");
                    $stmt->execute(array($id_formation));
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if($result)
                    {
                        //$out .=  $result[0]['nomFormation'];
                        $out .="<li class='link'><a href='".$result[0]['nomFormation']."'>".$result[0]['titre']."</a></li>";
                    }
                }
            }
        }
        $out .="</ul></div>";
        return $out;

    }
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
                "Reconnexion" => "login"
            ); break; //Student
            case '2' :
                $array_menu = array (
                "Formations" => "allFormation",
                "Corrections" => "correction",
                "Reconnexion" => "login"
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

    //-------------REGISTER-------------------//
    public function getFormRegister()
    {
        if(isset($_GET["submit"]) && $_GET["submit"] == "REGISTER")
        {
            $sql = DBConnection::getInstance();
            $stmt = $sql->prepare("INSERT INTO user (pseudo,password,idStatut) VALUES (?, ?, '1');");
            $stmt->execute(array($_GET["user"],$_GET["pwd"]));
            return "Vous êtes inscrit";
        }
        return "<form id=\"connexion\">
        <div class=\"form-group\">
        <label for=\"text\">Pseudo:</label>
        <input type=\"text\" class=\"form-control\" id=\"user\">
        </div>
        <div class=\"form-group\">
        <label for=\"pwd\">Mot de passe:</label>
        <input type=\"password\" class=\"form-control\" id=\"pwd\">
        </div>
        <button type=\"submit\" href=\"javascript::onclick();\" class=\"btn btn-default\" id=\"registerButton\">Inscription</button>
        </form>";
    }

}