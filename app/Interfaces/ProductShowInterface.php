<?php
namespace App\Interfaces;
use App\Models\Product;
use App\Models\Category;
interface ProductShowInterface {
    public function showProduct($slug) : Product;
    public function attrProduct($product);
}
?>