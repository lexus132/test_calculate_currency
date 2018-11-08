<?php

abstract class BaseCurrency
{

    public $title = '';
    public $baseUrl = '';
    public $data = [];

    public function runQuery() {
        $url = $this->baseUrl;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($curl, CURLOPT_HTTPHEADER);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        $response = curl_exec($curl);
        $data = json_decode($response);


        /* Check for 404 (file not found). */
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        // Check the HTTP Status code
        switch ($httpCode) {
            case 200:
                return [
                    'status' => 200,
                    'message' => 'Ok',
                    'data' => $data
                ];
                break;
            case 404:
                return [
                    'status' => 404,
                    'message' => "404: API Not found",
                    'data' => ''
                ];
                break;
            case 500:
                return [
                    'status' => 500,
                    'message' => "500: servers replied with an error.",
                    'data' => ''
                ];
                break;
            case 502:
                return [
                    'status' => 502,
                    'message' => "502: servers may be down or being upgraded. Hopefully they'll be OK soon!",
                    'data' => ''
                ];
                break;
            case 503:
                return [
                    'status' => 503,
                    'message' => "503: service unavailable. Hopefully they'll be OK soon!",
                    'data' => ''
                ];
                break;
            default:
                return [
                    'status' => '',
                    'message' => "Undocumented error: " . $httpCode . " : " . curl_error($curl),
                    'data' => ''
                ];
                break;
        }
        curl_close($curl);
        die;
    }

    public function getDate(){

        $data = $this->runQuery();
        if(!empty($data) and ($data['status'] === 200)){
            return [
                'status' => 200,
                'title' => $this->title,
                'data' => $this->parseDate($data['data'])
            ];
        } else if(!empty($data)){
            return [
                'status' => $data['status'],
                'title' => $this->title,
                'data' => $data['message']
            ];
        }
        return false;
    }

    abstract function parseDate($data);
        /*          Format return
            [
                [
                    'base_ccy' => 'title_1',
                    'ccy' => 'title_2',
                    'val' => 'val',
                ],
                ...
            ]
        */

}