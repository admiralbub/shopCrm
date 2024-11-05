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
        $wishlist = new Wishlist();
        $wishlist->user_id = $user_id;
        $wishlist->product_id = $product_id;
        $wishlist->save();
        
        return $wishlist;
        
    }
}