<?php

namespace App\Http\Controllers\Deliver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Deliver\Novaposhta;
use App\Models\NpCity;
use App\Models\NpWarehouse;
class NovaPoshtaController extends Controller
{
    public function getCity(Request $request) {
        $adr = new Novaposhta;
        $searchArray = $adr->getCityDB($request->city);

        return $searchArray;
    }
    public function getWarehouse(Request $request) {

        $adr = new Novaposhta;
        $searchArray = $adr->getWarehouseDB($request->warehouse,$request->city);
        return $searchArray;
    }

    public function getCityAll(Request $request) {
        $adr = new Novaposhta;
        $cityAll = $adr->getCitiesJSON();
       // dd($cityAll);
        return $cityAll;
    }
    public function getWarehouseAll(Request $request) {
        $adr = new Novaposhta;
        $cityAll = $adr->getWarehouseJSON();
        return $cityAll;
    }
    
}
