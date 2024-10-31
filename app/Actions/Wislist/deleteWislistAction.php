<?php

namespace App\Actions\Wislist;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
class deleteWislistAction
{
    /**
     * Create a new class instance.
     */
    public function execute(Wishlist $wishlist) {
        $wishlist->delete();
    }
}