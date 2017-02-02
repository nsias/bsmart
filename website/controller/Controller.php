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

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke()
    {
        if (!isset($_GET['content']))
        {
            // no special book is requested, we'll show a list of all available books
            $contents = $this->model->getContentList();
            include 'view/viewmain.php';
        }
        else
        {
            // show the requested book
            $content = $this->model->getContent($_GET['content']);
            include 'view/viewcontent.php';
        }
    }
}