<?php

namespace App\Http\Controllers\Deliver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Daaner\NovaPoshta\Models\Address;

class NovaPoshtaController extends Controller
{
    public function getCity(Request $request) {
        $adr = new Address;
        //работает ф-ция лимита, но можно и без нее, setPage - НЕ применяется
        $adr->setLimit(20);

        $settlements = $adr->searchSettlements($request->city);

        return $settlements['result'][0]['Addresses'];
    }
    public function getWarehouse(Request $request) {
        $adr = new Address;
        $warehouses = $adr->getWarehouses($request->warehouse, false);
        dd($warehouses);
    }
}
