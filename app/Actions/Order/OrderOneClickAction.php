<?php

namespace App\Actions\Order;
use App\Models\Order;
class OrderOneClickAction
{
    /**
     * Create a new class instance.
     */
    public function execute($request, $delivery_order,$pay_info,$total_summ_order): Order
    {
        $order = Order::create([
            'first_name'=>'Немає',
            'last_name'=>'Немає',
            'middle_name'=>'Немає',
            'phone'=>$request->phone,
            'delivery'=>$delivery_order,
            'status'=>0,
            'email'=>'Немає',
            'pay_info'=>$pay_info,
            'total'=>$total_summ_order*$request->quantity,
        ]);
        
        return $order;
        
    }
}