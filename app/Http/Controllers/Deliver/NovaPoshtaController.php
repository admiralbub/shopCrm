<?php

namespace App\Http\Controllers\Deliver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Deliver\Novaposhta;

class NovaPoshtaController extends Controller
{
    public function getCity(Request $request) {
        $adr = new Novaposhta;
    
        $settlements = $adr->getCityFilter($request->city);

        return $settlements->data[0]->Addresses;
    }
    public function getWarehouse(Request $request) {
        $adr = new Novaposhta;
        $warehouses = $adr->getWarehouseFilter($request->city, $request->warehouse);
        return $warehouses->data;
    }
}
