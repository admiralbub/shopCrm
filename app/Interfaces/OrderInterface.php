<?php
namespace App\Interfaces;
use App\Models\Order;
interface OrderInterface {
   static public function getOrderAdd($request,$totalBasket);
   static public function getProductAdd($baskets,$order_id);
   static public function showOrderAccount();
}

?>