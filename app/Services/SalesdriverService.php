<?php
namespace App\Services;
 
use App\Interfaces\SalesdriverInterface;
use App\Jobs\SendToSalesDrive;
use App\Models\Order;
class SalesdriverService implements SalesdriverInterface {
    public function addOrderinCrm($orderId) {
        $order = Order::findOrFail($orderId);
        SendToSalesDrive::dispatch('handler/', [
            "form" => "qleqMom3C0wiuOHs6YpcjOmxMQ54x5Getl6URoDM2JWZqodSlVkxvy6Oc0NKc9Vk_ptuY1NdQ",
            "first_name" => $order->first_name,
            "last_name" => $order->last_name,
            "phone" => $order->phone ?? '',
            "email" => $order->email ?? '',
           // "products" => $salesDriveProducts,

        ]);
    }

}

?>