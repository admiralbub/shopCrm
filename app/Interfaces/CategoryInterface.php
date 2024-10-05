<?php
namespace App\Interfaces;
use App\Models\Product;
use App\Models\Category;
interface CategoryInterface {
    public function getCategories($slug);
    public function getProduct(Category $category);
    public function getBrand($products,Category $category);
   // public function getSortProduct(Category $category,$sort);
}
?>