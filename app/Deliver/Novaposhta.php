<?php
namespace App\Deliver;
class Novaposhta {
	
	
    //private static $key = '2d27090ed77f23c0e23271f2726e1554';
    private static $key = '';
    private static $accessPointJSON = 'https://api.novaposhta.ua/v2.0/json/';

    public static function getCityFilter($city) {

        $request = '{
            "modelName": "Address",
            "calledMethod": "searchSettlements",
            "methodProperties": {
                "CityName": "' . $city . '"
        }}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$accessPointJSON);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/json"));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        $response = json_decode($response);

        return  $response;

    }
    public static function getWarehouseFilter($cityRef,$warehouse) {

        $request = '{
            "modelName": "Address",
            "calledMethod": "getWarehouses",
            "methodProperties": {
                "CityRef": "' . $cityRef . '",
                "FindByString":"' . $warehouse . '"
  
            }
        }';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$accessPointJSON);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/json"));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        $response = json_decode($response);
        

        return  $response;
          
  
  
  
  
  
    }

}