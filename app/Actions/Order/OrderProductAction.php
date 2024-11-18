<?php

namespace App\Actions\Order;
use App\Models\OrderProduct;
class OrderProductAction
{
    /**
     * Create a new class instance.
     */
    public function execute($product,$order_id): OrderProduct
    {
        $order = OrderProduct::create([
            'order_id'=>$order_id,
            'product_id'=>$product->id,
            'price'=>$product->price,
            'quantity'=>$product->quantity,
        ]);
        
        return $order;
        
    }
}