<?php
namespace App\Interfaces;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Category;
interface WishlistInterface {
    public function addWislist(int $productId);
    public function getWislist();
    public function countWislist();
    public function deleteProductWislist($id);
    static public function isMessageSuccess();
    static public function isMessageFail();
   
}
?>