<?php
/**
 * Created by PhpStorm.
 * User: siasn
 * Date: 02-02-17
 * Time: 14:23
 */
include_once("model/Content.php");

class Model {
    public function getContentList()
    {
        // here goes some hardcoded values to simulate the database
        return array(
            "Anglais" => new Content("Anglais", "Ceci est de l'anglais","09/02" , "10/05"), //"D.Verdonck"
            "Sécurité des réseaux" => new Content("Sécurité des réseaux","Ceci est une description de cours", "10/02", "15/05"),//"A.Vanham"
            "PHP" => new Content("PHP", "Ceci est le cours de Delvigne", "15/03","5/05") //"N.Sias
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