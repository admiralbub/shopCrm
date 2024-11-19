<?php
namespace App\Interfaces;
use App\Models\Product;
use App\Models\Category;
interface CategoryInterface {
    public function getCategories($slug);
    public function getProduct(Category $category);
    public function getBrand($products,Category $category);
    public function getSortProduct($products,Category $category,$sort);
    public function attrPrice($products,Category $category);
    public function getAllProduct($products,Category $category);
    public function filterPrice($minPrice,$maxPrice,$products,Category $category);
    public function attrProduct($products,Category $category);
    public function filterAttr($filter);
    public function setFilter($products, $filter);
    public function selectedFilter($attrFilter);
}
?>