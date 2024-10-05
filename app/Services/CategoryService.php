<?php
    namespace App\Services;
 
    use App\Interfaces\CategoryInterface;
    use App\Models\Brand;
    use App\Models\Product; 
    use App\Models\Category; 
    class CategoryService implements CategoryInterface {
     
        public function getCategories($slug) {
            $category = Category::where('slug', $slug)->published()->first();
            
           /* $products_id = $category->products()
                ->orderBy("status","ASC")
                ->published()
                ->get()
                ->pluck('id');
            $products = Product::whereIn('id', $products_id)->get();*/

            return $category;
        }
        public function getProduct(Category $category)
        {
            $products_id = $category->products()
                ->orderBy("status","ASC")
                ->published()
                ->get()
                ->pluck('id');
            $products = Product::whereIn('id', $products_id)->get();

            return $products;
        }
        public function getBrand($products,Category $category)
        {   
            $products_brands = $products;
        
            $list_brand=array();
            foreach ($products_brands as $product) {
                $list_brand[]=$product->brand_id;
            }
            $brands = Brand::whereIn("id",$list_brand)->get();
            return $brands;
        }
        public function getSortProduct(Product $product,$sort) {
            $products_id = $category->products()
                ->orderBy("status","ASC")
                ->published()
                ->get()
                ->pluck('id');
            $products_brands = Product::whereIn('id', $products_id)->get(); 
        }
     
    }
?>