<?php

class Session
{

    public function __construct()
    {
        foreach($_SESSION as $key => $value){
            if(!empty($value)){
                $this->{$key} = $value;
            }
        }
    }

    public function login($id = null)
    {
        if(!empty($id)){
            $_SESSION['user_id'] = (int)$id;
        }
    }

    public function logout()
    {
        $_SESSION['user_id'] = '';
        unset($_SESSION['user_id']);
    }


}