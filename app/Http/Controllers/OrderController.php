<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __invoke() {
        return view('cart.cart');
    }
}
