<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\BasketInterface;
use App\Breadcrumbs\Breadcrumb;

class BasketController extends Controller
{
    private $basket;

    public function __construct(BasketInterface $basket, Breadcrumb $breadcrumbs) {
        $this->breadcrumbs = $breadcrumbs;
        $this->basket = $basket;
    }
    public function __invoke() {
        $bread = [
            "name"=>__("Basket"),
            "route"=>"basket.index"
        ];
        $breadcrumbs = $this->breadcrumbs->breadPage($bread);
        $isAuth = $this->basket->isAuth();
        if($isAuth) {
            $baskets = $this->basket->showBasketDb($isAuth);
        } else {
            $baskets = $this->basket->showBasketSession();
        }
        $totalBasket = $this->basket->totalBasket($isAuth);
        return view('basket.index',[
            'breadcrumbs'=>$breadcrumbs,
            'baskets'=>$baskets,
            'totalBasket'=>$totalBasket
        ]);
    }
    public function countBasket(Request $request) {
        $isAuth = $this->basket->isAuth();
        return ['count'=>$this->basket->get_Count_Goods($isAuth)];
    }
    public function addBasket(Request $request) {
        if($this->basket->isAuth()) {
            
            $count = $this->basket->dbAddBasket(auth()->user()->id, $request->id, $request->packid,$request->quanity);    
            $message = $this->basket->isMessageSuccess();
        } else {
            $count = $this->basket->sessionAddBasket($request->id, $request->packid,$request->quanity);
            $message = $this->basket->isMessageSuccess();
        }
        return [
            'count'=>$count,
            'mess'=>$message
        ];



        
    }
    public function deleteBasket($id) {
        $auth_check = $this->basket->isAuth();
        $this->basket->deleteProductBasket($auth_check,$id);
    }

    public function quantity(Request $request) {
        $auth_check = $this->basket->isAuth();
        $this->basket->quantity($auth_check,$request->id,$request->quantity);
    }

    public function basketJson() {
        $isAuth = $this->basket->isAuth();
        if($isAuth) {
            $baskets = $this->basket->showBasketDb($isAuth);
        } else {
            $baskets = $this->basket->showBasketSession();
        }
        return response()->json([
            'baskets' => $baskets,
        ]);
    }
}
