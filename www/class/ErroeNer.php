<?php

class ErroeNer
{

    public function __construct()
    {

        $error = file_get_contents(realpath(__DIR__.'/..')."/error.html");

        header('Content-Type: text/html; charset=utf-8');
        echo $error;
        exit;
    }

}