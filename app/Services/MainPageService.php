<?php
namespace App\Services;
 
use App\Interfaces\MainPageInterface;

use App\Models\MainSlider; 
use App\Models\Product; 
use App\Models\Page; 
class MainPageService implements MainPageInterface {
    static public function getMainSlider()  {
        return MainSlider::available()
            ->active()
          
            ->orderBy('created_at', 'DESC')
            ->get();
    }
    static public function getProductNew() {
        return Product::new()
            ->available()
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    static public function getProductRecommended() {
        return Product::reccomended()
            ->available()
            ->orderBy('created_at', 'DESC')
            ->get() ?? 0;
    }

   static public function getProductPopular() {
        return Product::popular()
            ->available()
            ->orderBy('created_at', 'DESC')
            ->get() ?? 0;
   }
   static public function getProductSale() {
        return Product::sale()
            ->available()
            ->orderBy('created_at', 'DESC')
            ->get() ?? 0;
   }
   static public function getMainPage() {
        return Page::available()
            ->where('url','/')
            ->first();
   }
    
}

?>