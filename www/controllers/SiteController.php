<?php

class SiteController extends Controller
{

    public $name = 'site';

    public function index(){

        $this->title = 'Одесский форум';
        $this->breadcrumbs[] = 'Форум';
        $this->data['apiList'] = CurrencyList::getList();
        echo $this->render('index');

    }

    public function Currency(){
        $data = [
            'status' => 200,
            'message' => 'Ok',
            'data' => CurrencyList::getList()
        ];
        $this->json($data);
    }

//    public function Test(){
//
//    }

}
