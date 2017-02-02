<?php
/**
 * Created by PhpStorm.
 * User: siasn
 * Date: 02-02-17
 * Time: 14:23
 */
class Content {
    public $title;
    public $content;

    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }
}