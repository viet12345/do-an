<?php
use GuzzleHttp\Client;

if (!function_exists('convertCurrency')) {
    function convertCurrency($currency_from,$currency_to){
        $client = new Client;
        $request = $client->get('http://api.currencylayer.com/live?access_key=22fb444e7cd1b1fcc25d302e813e523b&currencies='.$currency_from.','.$currency_to);
        $response = $request->getBody();

        $response = $response->getContents();
        $arr = \json_decode($response);
        return $arr->quotes->USDVND;
    }
}
