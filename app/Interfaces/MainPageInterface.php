<?php
namespace App\Interfaces;
use App\Models\MainSlider;
interface MainPageInterface {
   static public function getMainSlider();
   static public function getMainPage();
   static public function getProductNew();
   static public function getProductRecommended();
   static public function getProductPopular();
   static public function getProductSale();

}

?>