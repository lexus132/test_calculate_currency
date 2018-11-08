<?php

use Jenssegers\Blade\Blade;

class Controller
{
    public $session;
    public $request;
    public $cache = 'cache';
    public $viewPath = 'view';
    public $viewClass = 'site';
    public $data = [
        'errors' => []
    ];
    public $title = '';
    public $breadcrumbs = [];

    public $head = [
                'htlm' => 'Content-Type: text/html; charset=utf-8',
                'json' => 'Content-Type: application/json'
            ];

    public function __construct()
    {
        $this->viewPath = realpath(__DIR__.'/..').'/view';
        $this->cache = realpath(__DIR__.'/..').'/cache';

        $fullClass = explode('\\', get_class($this));
        foreach($fullClass as $val){
            if(stripos($val, 'Controller') > 0){
                $let = stripos($val, 'Controller');
//                $this->viewClass = realpath($this->viewPath.'/'.mb_strtolower(substr($val, 0, $let)).'/');
                $this->viewClass = mb_strtolower(substr($val, 0, $let));
            }
        }

//        ActiveRecord\Config::initialize(function($cfg)
//        {
//            $cfg->set_model_directories( array( APP_BASE_PATH.'/Model' ) );
//            $cfg->set_connections( array( 'development' => 'mysql://'.DB_USER.':'.DB_PASSWORD.'@'.DB_HOST.'/'.DB_NAME.'?charset=utf8' ) );
//        });

        $this->request = new Request();
        if(!empty($this->request->get['_route_']))
            unset($this->request->get['_route_']);
//        $this->session = new Session();

        if(!empty($this->session->user_id)){
            $user = User::find((int)$this->session->user_id);
            $this->data['userName'] = $user->name;
        }
    }

    private function beforEction()
    {
        header($this->head['htlm']);
    }

    public function json($data=null)
    {
        header($this->head['json']);
        print_r(json_encode($data));
        exit;
    }

    public function render($view='')
    {
        $this->beforEction();

        if(!empty($view)){

            $blade = new Blade($this->viewPath, $this->cache);

            return $blade->make($this->viewClass.'.'.$view)->withData($this->data)->withTitle($this->title)->withBreadcrumbs($this->breadcrumbs)->render();
        }
    }

    public function layout()
    {
        $this->beforEction();

        $error = file_get_contents(realpath(__DIR__.'/..')."/view/layouts/html.blade.php");

        echo $error;
        exit;
    }

    public function cleanLine($line='')
    {
        if(!empty($line)){
            return trim(strip_tags($line));
        }
        return null;
    }

}