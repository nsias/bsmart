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
    public $json_data = [];

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke()
    {
        Session::_instance();
        if (!isset($_GET['content']))
        {
            // no special formations is requested, we'll show a list of all available contents
            $json_data['titleContent'] = $this->model->getContent("main")->title;
            $json_data['bodyContent'] = $this->model->getContent("main")->content;
            include 'view/viewmain.php';
        }
        else
        {
            // show the requested content
            $json_data['titleContent'] = $this->model->getContent($_GET['content'])->title;
            $json_data['bodyContent'] = $this->model->getContent($_GET['content'])->content;
            //include 'view/viewmain.php';
        }
        die(json_encode($json_data));
    }
}