<?php

namespace App\Actions\Basket;
use App\Models\Basket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AddBasketAction
{
    /**
     * Create a new class instance.
     */
    public function execute($id_user,$id_product,$packId,$quantity)
    {
        $basket = new Basket();
        $basket->user_id = $id_user;
        $basket->product_id = $id_product;
        $basket->quantity = $quantity;
        $basket->pack_id = $packId;
        $basket->save();
    }
}
