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
            "security" => new Content("Sécurité des réseaux",$this->getFormationContent("security")),//"A.Vanham"
            "php" => new Content("PHP", $this->getFormationContent("php")),
            "evaluation" => new Content("Vos evaluations", "Ceci est la liste des eval"),
            "register" => new Content("Inscription", $this->getFormRegister()),
            "login" => new Content("Connexion", $this->getFormConnection()),
            "allFormation" => new Content("Toutes les formations", $this->getFormationByUser()),
            "paiement" => new Content("Payez ici pour avoir cette formation", "<div class=\"starpass-div\">
<div id=\"starpass_321987\"></div><script type=\"text/javascript\" src=\"http://script.starpass.fr/script.php?idd=321987&amp;verif_en_php=1&amp;datas=\"></script><noscript>Veuillez activer le Javascript de votre navigateur s'il vous pla&icirc;t.<br /><a href=\"http://www.starpass.fr/\">Micro Paiement StarPass</a></noscript>
</div>"),
            "correction" => new Content("Vos corrections","Vous n'avez aucune correction"),
            "evaluation" => new Content("Vos evaluations", $this->getQuizzByUser()),
            "englishQuizz" => new Content ("Evaluation du cours d'Anglais", "Vous avez déjà fait cette évaluation"),
            "phpQuizz" => new Content ("Evaluation du cours de PHP", $this->getQuizz())
        );
    }

    public function getContent($title)
    {
        // we use the previous function to get all the books and then we return the requested one.
        // in the future, this will be done through a db select command
        $allContents = $this->getContentList();
        return $allContents[$title];
    }


    //--------------QUIZZ METHODS --------------//
    public function getQuizzByUser()
    {
        if(!isset($_SESSION["id"]))
            return "Vous n'êtes pas connecté";
        $out = '<ul>';
        $sql = DBConnection::getInstance();
        $stmt = $sql->prepare("SELECT * FROM formation");
        $stmt->execute();
        $db_result_form = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $stmt2 = $sql->prepare("SELECT idFormation FROM user_formation WHERE idUser= ?");
        $stmt2->execute(array($_SESSION["id"]));
        $db_result_id = $stmt2->fetchAll(PDO::FETCH_ASSOC);



        if($db_result_form)
        {
            foreach($db_result_form as $formation)
            {
                $isPaid = false;
                if($db_result_id)
                {
                    foreach($db_result_id as $id)
                    {
                        if($formation['idFormation'] == $id['idFormation'])
                        {
                            $out .="<li class='link'><a style='color:green' href='".$formation['nomFormation']."Quizz'>".$formation['titre']."</a></li>";
                            $isPaid = true;
                        }
                    }
                }
                if(!$isPaid)
                    $out .="<li class='link'><a style='color:red' href='paiement'>".$formation['titre']."(Vous n'avez pas acces, cliquez dessus pour payer pour cette formation)</a></li>";
            }
        }
        $out .="</ul>";
        return utf8_encode($out);
    }


    public function getQuizz()
    {
        return "<pre> Comment déclarer une variable en php ?</pre><form><div class=\"checkbox\">
  <label><input type=\"checkbox\" value=\"\">En mettant un $ puis le nom de la variable</label>
</div>
<div class=\"checkbox\">
  <label><input type=\"checkbox\" value=\"\">En téléphonant au père Noël 08.36.65.65.65</label>
</div>
<div class=\"checkbox\">
  <label><input type=\"checkbox\" value=\"\">En demandant à monsieur Delvigne</label>
</div>
<button type=\"submit\" href=\"javascript::onclick();\" class=\"btn btn-default\" id=\"quizzButton\">Envoyer</button></form>";
    }



    //--------------FORMATIONS METHODS -------------//

    public function getFormationByUser()
    {
        if(!isset($_SESSION["id"]))
            return "Vous n'êtes pas connecté";
        $out = '<ul>';
        $sql = DBConnection::getInstance();
        $stmt = $sql->prepare("SELECT * FROM formation");
        $stmt->execute();
        $db_result_form = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $stmt2 = $sql->prepare("SELECT idFormation FROM user_formation WHERE idUser= ?");
        $stmt2->execute(array($_SESSION["id"]));
        $db_result_id = $stmt2->fetchAll(PDO::FETCH_ASSOC);



        if($db_result_form)
        {
            foreach($db_result_form as $formation)
            {
                $isPaid = false;
                if($db_result_id)
                {
                    foreach($db_result_id as $id)
                    {
                        if($formation['idFormation'] == $id['idFormation'])
                        {
                            $out .="<li class='link'><a style='color:green' href='".$formation['nomFormation']."'>".$formation['titre']."</a></li>";
                            $isPaid = true;
                        }
                    }
                }
                if(!$isPaid)
                    $out .="<li class='link'><a style='color:red' href='paiement'>".$formation['titre']."(Vous n'avez pas acces, cliquez dessus pour payer pour cette formation)</a></li>";
            }
        }
        $out .="</ul>";
        return utf8_encode($out);
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