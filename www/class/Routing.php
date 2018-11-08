<?php

use ErroeNer;

class Routing
{
    public $controllerPath;
    public $controller = 'SiteController';
    public $action = 'index';
    private $query = '';

    public function __construct()
    {
        $this->controllerPath = realpath(__DIR__.'/..').'/controllers/';
        $this->query = $_SERVER['QUERY_STRING'];
        $this->parseQuery();
    }

    private function parseQuery()
    {
        if(strpos($this->query, '_route_') === 0){
            $dataArr = explode('=',$this->query);
            if($dataArr[0] == '_route_'){
                if(!empty($dataArr[1])){
                    $routeParam =  explode('/', $dataArr[1]);
                    if(!empty($routeParam[0])){
                        $controllerLine = mb_strtolower($routeParam[0]);
                        $controllerName = ucfirst($controllerLine).'Controller';
                        $controllerFile = ucfirst($controllerLine).'Controller.php';

                        if(is_file($this->controllerPath.$controllerFile)){

                            if($controllerLine != 'site')
                                require $this->controllerPath.$controllerFile;

                            $contr = $controllerName;
                            if($controller =  new $contr()){
                                $this->controller = $controllerName;
                                if(!empty($routeParam[1])){
                                    $actionLine = mb_strtolower($routeParam[1]);

                                    if(method_exists($controller,$actionLine)){
                                        $this->action = $actionLine;
                                    }
                                }
                            }
                        } else {
                            new ErroeNer();
                        }
                    }
                }
            }
        }
    }
}