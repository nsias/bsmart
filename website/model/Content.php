<?php
/**
 * Created by PhpStorm.
 * User: siasn
 * Date: 02-02-17
 * Time: 14:23
 */
class Content {
    public $title;
    public $description;
    public $begin_date;
    public $final_date;

    public function __construct($title, $description, $begin_date, $final_date)
    {
        $this->title = $title;
        $this->theory = $description;
        $this->begin_date = $begin_date;
        $this->final_date = $final_date;
    }
}