<?php

use BaseCurrency;

class PrivatbankCurrency extends BaseCurrency
{

    public $title = 'privatbank';
    public $baseUrl = 'https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11';

    function parseDate($data){

        $rezult = [];
        $allCurr = [];
        foreach($data as $item){
            $allCurr[$item->ccy] = $item->ccy;
            $allCurr[$item->base_ccy] = $item->base_ccy;
        }
        $allCurr = $this->generate($allCurr);
        foreach($data as $item){
            $allCurr[$item->ccy][$item->ccy] = 1;
            $allCurr[$item->ccy][$item->base_ccy] = round(((float)$item->buy+(float)$item->sale)/2, 2);
            $allCurr[$item->base_ccy][$item->base_ccy] = 1;
            $allCurr[$item->base_ccy][$item->ccy] = round(1/(((float)$item->buy+(float)$item->sale)/2), 2);
        }
        foreach($allCurr as $allK => $allV){
            foreach($allV as $iteK => $iteV){
                if($iteK === $iteV){
                    $nedd = $iteV;
                    foreach($allCurr[$nedd] as $promK => $promV){
                        if($promK !== $promV and $promV !== 1){
                            $flag = $promK;
                            if(is_float($allCurr[$flag][$allK]) and is_float($allCurr[$nedd][$flag])){
                                $some_rez = $allCurr[$flag][$allK]*$allCurr[$nedd][$flag];
                                $allCurr[$nedd][$allK] = round($some_rez, 2);
                            }
                        }
                    }
                }
            }
        }
        foreach($allCurr as $allK => $allV){
            foreach($allV as $iteK => $iteV){
                $rezult[] = [
                    'base_ccy' => $allK,
                    'ccy' => $iteK,
                    'val' => $iteV
                ];
            }
        }

        return $rezult;
    }

    public function generate($arr)
    {
        $rezult = [];
        foreach($arr as $key => $val){
            $rezult[$val] = $arr;
        }
        return $rezult;
    }
}
