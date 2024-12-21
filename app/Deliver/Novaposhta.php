<?php
namespace App\Deliver;
use App\Models\NpCity;
use App\Models\NpWarehouse;
use App\Jobs\FetchWarehousesNpJob;
class Novaposhta {
	
	
    //private static $key = '2d27090ed77f23c0e23271f2726e1554';
    private static $key = '';
    private  $accessPointJSON = 'https://api.novaposhta.ua/v2.0/json/';

    public static function getCityDB($city) {

        $searchArray = [];
        $settlements = NpCity::where('Description', 'LIKE', "%{$city}%")->get();
        // Преобразуем коллекцию и сортируем
        $searchArray = $settlements->sortBy(function ($settlement) {
            // Сортируем так, чтобы те, что содержат "місто", были первыми
            return stripos($settlement->Description, 'місто') === false ? 1 : 0;
        })->map(function ($sea) {
            return [
                'Description' => $sea->Description,
                'Ref' => $sea->Ref,
            ];
        })->values(); // Преобразуем обратно в массив индексов

        return $searchArray;
    }
    public static function getWarehouseDB($warehouse,$city) {

        $searchArray = [];
        $settlements = NpWarehouse::where('Description', 'LIKE', "%{$warehouse}%")->where('CityRef',$city)->get();
        foreach ($settlements as $sea) {
            $searchArray[] = [
                'Description'=>$sea->Description,
                'Ref'=>$sea->Ref,
            ];
        }
        return $searchArray;
          
    }
    public static function getCitiesJSON() {
 
        NpCity::query()->delete();

        $request = '{
            "modelName": "Address",
            "calledMethod": "getCities",
            "methodProperties": {}
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
        $resp_arr = array();

        foreach ($response->data as $city) {
            $np = new NpCity();
            $np->Description = $city->SettlementTypeDescription.' '.$city->Description;
            $np->DescriptionRu = $city->SettlementTypeDescriptionRu.' '.$city->DescriptionRu;
            $np->Ref = $city->Ref;
            $np->save();
        }
        
        return  $resp_arr;
    }

    public function getWarehouseJSON() {
 
        NpWarehouse::query()->delete();
        
        dispatch(new FetchWarehousesNpJob($this->accessPointJSON));
    }

}