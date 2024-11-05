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
        return Basket::create([
            "user_id"=>$id_user,
            "product_id"=>$id_product,
            "quantity"=>$quantity,
            "pack_id"=>$packId
        ]);
       
    }
}
