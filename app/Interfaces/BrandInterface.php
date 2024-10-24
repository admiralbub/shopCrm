<?php
namespace App\Interfaces;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
interface BrandInterface {
    public function getListBrand();
    public function getBrandBySlug($slug);
    public function getBrandCat(Brand $brand);
}
?>