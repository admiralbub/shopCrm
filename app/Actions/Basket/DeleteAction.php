<?php

namespace App\Actions\Basket;
use App\Models\Basket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class DeleteAction
{
    public function execute(Basket $basket) {
        $basket->delete();
    }
}
?>