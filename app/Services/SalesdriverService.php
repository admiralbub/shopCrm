<?php
namespace App\Services;
 
use App\Interfaces\SalesdriverInterface;
use App\Jobs\SendToSalesDrive;
use App\Models\Order;
class SalesdriverService implements SalesdriverInterface {
    public function addOrderinCrm($orderId) {
        $order = Order::findOrFail($orderId);
       // dd($order->first_name);
        $deliver_branch = json_decode($order->delivery, true);
        $isNP = strpos($deliver_branch['deliver'], 'NP') !== false;
        $salesDriveProducts = [];
        foreach ($order->products as $product) {
            $salesDriveProducts[] = [
                'id' => $product->id,
                'name' => $product->name,
                'costPerItem' => intval($product->pivot->price / $product->pivot->quantity),
                'amount' => $product->pivot->quantity,
            ];
        }
     


        SendToSalesDrive::dispatch('handler/', [
            "form" => "qleqMom3C0wiuOHs6YpcjOmxMQ54x5Getl6URoDM2JWZqodSlVkxvy6Oc0NKc9Vk_ptuY1NdQ",
            "fName" => $order->first_name,
            "lName" => $order->last_name,
            "mName" =>  $order->middle_name ?? "",
            "phone" => $order->phone ?? '',
            "email" => $order->email ?? '',
            "externalId"=>$order->id,
            "comment" => $order->comment ?? '',
            "products" => $salesDriveProducts,
            "novaposhta" => [
                "city" => $deliver_branch['city_ref'],
                "ServiceType" => $isNP ? ($deliver_branch['deliver'] === 'NP' ? 'DoorsWarehouse' : 'DoorsDoors') : '',
                "WarehouseNumber" => $deliver_branch['warehouse_ref'],

                "StreetRef" => "",
                "BuildingNumber" => "",
                "Flat" => "",
                "backwardDeliveryCargoType" => "",
                "paymentForm" => ""
            ],
           // "products" => $salesDriveProducts,

        ]);
    }

}

?>