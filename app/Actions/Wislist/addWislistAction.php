<?php

namespace App\Actions\Wislist;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
class addWislistAction
{
    /**
     * Create a new class instance.
     */
    public function execute($user_id,$product_id) : Wishlist
    {

        return Wishlist::create([
            "user_id"=>$user_id,
            "product_id"=>$product_id
        ]);
        
    }
}