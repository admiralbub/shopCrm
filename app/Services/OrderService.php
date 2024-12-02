<?php
namespace App\Services;
 
use App\Interfaces\OrderInterface;

use App\Models\Order; 
use App\Models\Product; 
use App\Actions\Order\OrderAction;
use App\Actions\Order\OrderProductAction;

use App\Actions\Order\OrderOneClickAction;
use Snowfire\Beautymail\Beautymail;
use App\Actions\Order\AddProductOneClickAction;
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

    static public function setProductOneClick($id) {
        $product = Product::where('id',$id)->available()->first();
        return $product;
    }
    static public function getOneClickAdd($request,$price) {
        $delivery_order = [
            'deliver' =>  '',
            'city_np' =>  '',
            'warehouse_np' => '',
            'city_ref' => '',
            'warehouse_ref' => '',
        ];

        $delivery_order = json_encode($delivery_order);

        $pay_info = [
            'pay_title' =>  '',
        ];
   
        $pay_info = json_encode($pay_info);
        $order = (new OrderOneClickAction())->execute($request,$delivery_order,$pay_info,$price);
        return $order->id;
    }
    static public function getOneClickAddProduct($order_id,$baskets) {
        return (new AddProductOneClickAction())->execute($baskets,$order_id);
    }
    static public function sendEmailOrder() {

        $order_last = Order::latest()->first();
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('email.order', ['id'=>$order_last->id,'name'=>$order_last->first_name,'products'=>$order_last->products,'order_last'=> $order_last], function($message) use ($order_last) {
            $message
                ->from(config('app.email'))
                ->to($order_last->email)
                ->subject('Замовлення №'.$order_last->id.' отримано, найближчим часом буде прийнято в роботу.');
            });
    }
}

?>