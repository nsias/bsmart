<?php
/**
 * Created by PhpStorm.
 * User: siasn
 * Date: 02-02-17
 * Time: 15:32
 */
class Formation {
    public $id;
    public $title;
    public $content;
    public $begin_date;
    public $end_date;

    public function __construct($id, $title, $content, $begin_date,$end_date)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->begin_date = $begin_date;
        $this->end_date = $end_date;
    }
}