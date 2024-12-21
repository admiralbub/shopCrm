<?php
namespace App\Deliver;
use App\Models\NpCity;
use App\Models\NpWarehouse;
use App\Jobs\FetchWarehousesNpJob;
use App\Jobs\FetchCityNpJob;
use Illuminate\Support\Facades\Http;
class Novaposhta {
	
	
    //private static $key = '2d27090ed77f23c0e23271f2726e1554';
    //private static $key = '';
 //   private  $accessPointJSON = 'https://api.novaposhta.ua/v2.0/json/';

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
        dispatch(new FetchCityNpJob(1));
        return response()->json(['message' => 'Задача поставлена в очередь для обработки']);
      
    }

    public function getWarehouseJSON() {
 
        NpWarehouse::query()->delete();
        dispatch(new FetchWarehousesNpJob(1));
        return response()->json(['message' => 'Задача поставлена в очередь для обработки']);

    }

}