<?php

class Request
{
    public $method;
    public $get = [];
    public $post = [];

    public function __construct()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $this->method = 'GET';
        }
        if(!empty($_GET)){
            foreach($_GET as $key => $val){
                $this->get[$key] = $val;
            }
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->method = 'POST';
        }
        if(!empty($_POST)){
            foreach($_POST as $key => $val){
                $this->post[$key] = $val;
            }
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}