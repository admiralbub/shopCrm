<?php

namespace App\Actions\Order;
use App\Models\Order;
class OrderAction
{
    /**
     * Create a new class instance.
     */
    public function execute($request, $delivery_order,$pay_info,$total_summ_order): Order
    {
        $order = Order::create([
            'user_id'=>auth()->check() ? auth()->user()->id : '',
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'middle_name'=>$request->middle_name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'comment'=>$request->notes_order,
            'delivery'=>$delivery_order,
            'pay_info'=>$pay_info,
            'status'=>0,
            'total'=>$total_summ_order,
        ]);
        
        return $order;
        
    }
}