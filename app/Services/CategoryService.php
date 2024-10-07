<?php
    namespace App\Services;
 
    use App\Interfaces\CategoryInterface;
    use App\Models\Brand;
    use App\Models\Product; 
    use App\Models\Category; 
    use Illuminate\Pagination\LengthAwarePaginator;
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
                
            $products = Product::whereIn('id', $products_id)->isCategory();

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
        public function getSortProduct($products,Category $category,$sort) {
            //Сортировка названий товар по возрастанию
            if ($sort== 'sort-name_asc') {
                $products = $products->orderBy('name_'.app()->getLocale(), 'asc');
            }else if ($sort == 'sort-name_desc') { //Сортировка названий товар по убыванию
                $products = $products->orderBy('name_'.app()->getLocale(), 'desc');
            }else if ($sort == 'sort-price_desc') {  //Сортировка цен по убыванию
                $paginated_shops =$products->with('packs')
                    ->paginate(10);
                $shops = $paginated_shops->sortByDESC(function($prod) {
                    return ceil(($prod->packs->count() > 0 ? $prod->packs->first()->volume : 1) * $prod->price);
                });
                $page = request()->get('page', 1);
                $products = new LengthAwarePaginator($shops, $paginated_shops->total(), $paginated_shops->perPage());
                $currentURL = url()->current();
                $products = $products->withPath($currentURL); 
            }else if ($sort == 'sort-price_asc') { //Сортировка цен по возростанию
                $paginated_shops = $products->with('packs')->paginate(10);
                $shops = $paginated_shops->sortBy(function($prod) {
                    return ceil(($prod->packs->count() > 0 ? $prod->packs->first()->volume : 1) * $prod->price);
                });
                $page = request()->get('page', 1);
                $products = new LengthAwarePaginator($shops, $paginated_shops->total(), $paginated_shops->perPage());
                $currentURL = url()->current();
                $products = $products->withPath($currentURL); 
                return $products;
            } else {
                return $products;
            }
        }
     
    }
?>