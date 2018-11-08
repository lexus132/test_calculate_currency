<?php

use PrivatbankCurrency;
use BankuaCurrency;
use EcbeuropaCurrency;
use InstaforexCurrency;

class CurrencyList
{
    public static function getList(){
        $rezult = [];

        $privat = new PrivatbankCurrency();
        $rezult[] = $privat->getDate();

        $bua = new BankuaCurrency();
        $rezult[] = $bua->getDate();

//        $ecb = new EcbeuropaCurrency();
//        $rezult[] = $ecb->getDate();

        $ins = new InstaforexCurrency();
        $rezult[] = $ins->getDate();

        return $rezult;
    }
}