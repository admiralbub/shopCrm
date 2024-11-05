<?php
namespace App\Services;
 
use App\Interfaces\BrandInterface;
use App\Models\Brand;
use App\Models\Product; 
use Illuminate\Pagination\LengthAwarePaginator;
    


class BrandService implements BrandInterface {
    public const PAGE_COUNT = 10;
    public function getListBrand() {
        $brands = Brand::published()->paginate(self::PAGE_COUNT);
        return $brands;
    }
    public function getBrandBySlug($slug) {
        $brand = Brand::where('slug', $slug)
            ->firstOrFail();

        return $brand;


    }
    public function getBrandCat(Brand $brand) {
        $brand_st = $brand->products->map(
            function ($item) {
                $category = $item->categories->first->getRootCategory();
                if ($category && $category->category_id == null) {
                    $category = $item->categories->first();
                }
                if ($category && $category->parent && $category->parent->parent) {
                    $category = $category->parent;
                }
                if (!$category) {
                    $category = $item->categories->first();
                }
                return $category;
            })
            ->unique("id")
            ->sortBy('id')
            ->chunk(3);
        return $brand_st;
    }
}

?>