<?php
namespace App\Interfaces;
use App\Models\Product;
use App\Models\Category;
use App\Models\Basket;
use App\Models\User;
interface BasketInterface {
    static public function isAuth();
    static public function sessionAddBasket($id, $packid,$productQuantity);
    static public function dbAddBasket($user_id, $productId, $packid,$productQuantity);
    static public function get_Count_Goods($isAuth);
    static public function showBasketSession();
    static public function showBasketDb($user_id);
    static public function totalBasket($isAuth);
    static public function deleteProductBasket($isAuth,$id);
    static public function quantity($isAuth,$product_id,$quantity);
    
    static public function isMessageSuccess();
}

?>