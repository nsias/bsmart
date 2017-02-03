<?php
/**
 * Created by PhpStorm.
 * User: siasn
 * Date: 02-02-17
 * Time: 14:21
 */
include_once("model/Model.php");
include_once("controller/Session.php");

class Controller {
    public $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke()
    {
        Session::_instance();
        if (!isset($_GET['content']))
        {
            // no special book is requested, we'll show a list of all available contents
            $content = $this->model->getContent("main");
            include 'view/viewmain.php';
        }
        else
        {
            // show the requested content
            $content = $this->model->getContent($_GET['content']);
            include 'view/viewmain.php';
        }
    }
}