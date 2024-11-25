<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\OrderInterface;
use App\Interfaces\BasketInterface;
use App\Http\Requests\OrderRequest;
class OrderController extends Controller
{
    public $order;
    public $basket;
    public function __construct(OrderInterface $order,BasketInterface $basket)
    {
        $this->order = $order;
        $this->basket = $basket;
    }
    public function __invoke() {
        if($this->basket->get_Count_Goods(auth()->check()) == 0) {
            abort(404);
        }
        return view('cart.cart');
    }

    public function store(OrderRequest $request) {

        $isAuth = $this->basket->isAuth();
        $totalBasket = $this->basket->totalBasket($isAuth);
        $sendOrder = $this->order->getOrderAdd($request,$totalBasket);
        $isAuth = $this->basket->isAuth();
        if($isAuth) {
            $baskets = $this->basket->showBasketDb($isAuth);
        } else {
            $baskets = $this->basket->showBasketSession();
        }
        $addProductOrder = $this->order->getProductAdd($baskets,$sendOrder);
        $clearBasket = $this->basket->clearBasket($isAuth);
        return response()->json([
            'success'=>  __('You have successfully placed your order'),
            'redirect' => route('profile')
        ]);
    }
    public function getOrder() {
        $orders = $this->order->showOrderAccount();
        return view('cabinet.orders',[
            'orders'=>$orders
        ]);
    }
}
