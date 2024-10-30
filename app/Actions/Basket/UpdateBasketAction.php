<?php

namespace App\Actions\Basket;
use App\Models\Basket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UpdateBasketAction
{
    /**
     * Create a new class instance.
     */
    public function execute(Basket $basket, $quantity)
    {
        $basket->update([
            'quantity' => $quantity
        ]);
    }
}
