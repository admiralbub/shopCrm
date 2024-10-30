<?php
namespace App\Interfaces;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Category;
interface WishlistInterface {
    public function addWislist(Product $product);
    public function deleteProductWislist(Wishlist $wishlist);
}
?>