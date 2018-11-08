<?php

class EcbeuropaCurrency extends BaseCurrency
{

    public $title = 'ecb.europa';
    public $baseUrl = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';


    public function runQuery() {
        $url = $this->baseUrl;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        $response = curl_exec($curl);
//        $data = json_decode($response);


        $p = xml_parser_create();
        xml_parse_into_struct($p, $response, $vals, $index);
        xml_parser_free($p);

        if(!empty($vals))
            return [
                'status' => 200,
                'message' => 'Ok',
                'data' => $vals
            ];

        return false;
    }


    function parseDate($data){
        $rezult = [];
        foreach($data as $item){
            if(!empty($item['attributes']) and !empty($item['attributes']['CURRENCY']) and !empty($item['attributes']['RATE']))
                $rezult[] = [
                    'base_ccy' => 'EUR',
                    'ccy' => $item['attributes']['CURRENCY'],
                    'val' => (float)$item['attributes']['RATE']
                ];
        }
        $data=$rezult;
        $rezult = [];
        $allCurr = [];
        foreach($data as $item){
            $allCurr[$item['ccy']] = $item['ccy'];
            $allCurr[$item['base_ccy']] = $item['base_ccy'];
        }
        $allCurr = $this->generate($allCurr);
        foreach($data as $item){
            $allCurr[$item['ccy']][$item['ccy']] = 1;
            $allCurr[$item['ccy']][$item['base_ccy']] = round((1/$item['val']), 2);
            $allCurr[$item['base_ccy']][$item['base_ccy']] = 1;
            $allCurr[$item['base_ccy']][$item['ccy']] = $item['val'];
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