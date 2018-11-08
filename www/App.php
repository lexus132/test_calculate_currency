<?php

final class App
{
    public $controller = 'SiteController';
    public $action = 'index';
    public $config = [];

    /**
     * @var Singleton
     */
    private static $instance;

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     *
     */
    private function __construct()
    {
    }

    /**
     *
     */
    private function __clone()
    {
    }

    /**
     *
     */
    private function __wakeup()
    {
    }


    /*
     * Configurate app
     * */
    public function config(Array $config = [])
    {
        if(!empty($config)){
            foreach($config as $key => $val){
                $this->{$key} = $val;
            }

//            $this->initModels();

            $this->routing();

        }
        return false;
    }

    private function initModels()
    {
        $dir = scandir(APP_BASE_PATH .'/Model');
        if(!empty($dir)){
            foreach($dir as $item){
                if(
                    ($item != '.') and
                    ($item != '..') and
                    (is_file(APP_BASE_PATH .'/Model/'.$item)) and
                    ($item != 'ActiveRecord.php')
                ){
                    require APP_BASE_PATH .'/Model/'.$item;
                }
            }
        }
    }

    private function routing()
    {
        $rots = new Routing();
        $this->controller = $rots->controller;
        $this->action = $rots->action;
    }

    public function run()
    {
        $contr = $this->controller;
        $controller =  new $contr();
        $controller->title = $this->name;
        $controller->{$this->action}();
    }

}