<?php
namespace App\Services;
 
use App\Interfaces\OrderInterface;

use App\Models\Order; 
use App\Actions\Order\OrderAction;
use App\Actions\Order\OrderProductAction;
class OrderService implements OrderInterface {
    static public function getOrderAdd($request,$totalBasket) {
        $delivery_order = [
            'deliver' => $request->deliver ?? '',
            'city_np' => $request->city_np ?? '',
            'warehouse_np' => $request->warehouse_np ?? '',
            'city_ref' => $request->city_ref_np ?? '',
            'warehouse_ref' => $request->warehouse_ref_np ?? '',
        ];

        $delivery_order = json_encode($delivery_order);

        $pay_info = [
            'pay_title' => $request->pay ?? '',
        ];
   
        $pay_info = json_encode($pay_info);

        $order = (new OrderAction())->execute($request,$delivery_order,$pay_info,$totalBasket);
        return $order->id;
    }
    static public function getProductAdd($baskets,$order_id) {
        foreach ($baskets as $product) {
            (new OrderProductAction())->execute($product,$order_id);
        }
    }
    static public function showOrderAccount() {
        return Order::where('user_id',auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(8);
    }
}

?>