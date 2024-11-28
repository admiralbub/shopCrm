<?php
namespace App\Services;
 
use App\Interfaces\ProductInterface;
use App\Models\Brand;
use App\Models\Product; 
use App\Models\Category; 
use App\Models\Attr; 
use App\Models\AttrGroup; 
use Illuminate\Pagination\LengthAwarePaginator;
    


class ProductService implements ProductInterface {
    public const PAGE_COUNT = 22;
    public function showProduct($slug) : Product {
        return Product::where('slug',$slug)->first();
    }
    public function attrProductShow($product) {
        $list_attr=array();
        foreach( $product->attrs as $attr) {
            $list_attr[] = $attr->id;
        }
        $attr = Attr::whereIn("id",$list_attr)->get();
        $attr = $attr->groupBy(function($item) {
            return $item->group_text;
        });
        return $attr;
    }
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
            
        $product_ids = $category->products()
            ->published()
            ->get()
            ->pluck('id');

        foreach ($category->children as $child) {
            $product_ids = $product_ids->merge(
                $child->products()
                            
                ->pluck('products.id')  // Specify the table name here
                ->values()

            );
        
            foreach ($child->childs as $third) {
                $product_ids = $product_ids->merge(
                    $third->products() 
                        ->get()
                        ->pluck('id')
                        ->values()
                );
            }
        }
        $products = Product::whereIn('id', $product_ids)->orderBy("status","ASC")->isCategory();

        return $products;
    }
    public function getAllProduct($products,Category $category) {
        return $products->paginate(self::PAGE_COUNT);
    }
    public function getBrand($products,Category $category)
    {   
        $products_brands = $products->get();
        
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
            return $products->paginate(self::PAGE_COUNT);
        }else if ($sort == 'sort-name_desc') { //Сортировка названий товар по убыванию
            $products = $products->orderBy('name_'.app()->getLocale(), 'desc');
            return $products->paginate(self::PAGE_COUNT);
        }else if ($sort == 'sort-price_desc') {  //Сортировка цен по убыванию
            $products = $products->with('packs')->paginate(self::PAGE_COUNT);

            $productsCollection = $products->getCollection()->sortByDESC(function($prod) {
                return ceil(($prod->packs->count() > 0 ? $prod->packs->first()->volume : 1) * $prod->price);
            });
                
            return $products->setCollection($productsCollection);
        }else if ($sort == 'sort-price_asc') { //Сортировка цен по возростанию
            $products = $products->with('packs')->paginate(self::PAGE_COUNT);
            $productsCollection = $products->getCollection()->sortBy(function($prod) {
                return ceil(($prod->packs->count() > 0 ? $prod->packs->first()->volume : 1) * $prod->price);
            });
            return $products->setCollection($productsCollection);
        } 
            
    }
    public function attrPrice($products,Category $category) {
        $products = $products->get();
        $price = array();
        foreach($products as $price_pr) {
            $price[] = ceil($price_pr->price * ($price_pr->packs->count() > 0 ? $price_pr->packs->first()->volume : 1));
        }
        return $price;

    }
    public function filterPrice($minPrice,$maxPrice,$products,Category $category) {
         return $products->whereHas('packs', function ($query) use ($minPrice, $maxPrice) {
            $query->where('volume', '>', 0) // Проверка, что объем больше 0
                ->whereRaw('price * volume >= ? AND price * volume <= ?', [$minPrice, $maxPrice]);
        })->paginate(self::PAGE_COUNT);
    }
    public function attrProduct($products,Category $category) {
        $products = $products->get();  
        $list_attr=array();
        foreach ($products as $product) {
            foreach( $product->attrs as $attr) {
                $list_attr[] = $attr->id;
            }
        }
        $attr = Attr::whereIn("id",$list_attr)->get();
        $attr = $attr->groupBy(function($item) {
            return $item->group_text;
        });
        return $attr;
    }
    public function setFilter($filter) {
        $filter_str = explode('/',$filter);
            
        //dd($filter_str);
        $filter = array();
        if (sizeof($filter_str)) {
            foreach ($filter_str as $key=>$str) {
                if ($str!='') {
                    $val= explode('-',$str);
                    $filter[$val[0]] = explode('_',$val[1]);
                }
 
            }
        }
        return $filter;
    }
    
    public function filterAttr($productsQuery, $filter) {
        if ($filter) {
            $filter = $this->setFilter($filter);
        }
    
        // Фильтр по брендам
        if (!empty($filter["brand"])) {
            $r_brands = $filter["brand"];
            $productsQuery->whereHas(
                'brand',
                function ($q) use ($r_brands) {
                    $q->whereIn('id', $r_brands);
                }
            );
        }
    
        // Фильтр по культурам
        if (!empty($filter["cult"])) {
            $r_cult = $filter["cult"];
            $productsQuery->whereHas(
                'attrs',
                function ($q) use ($r_cult) {
                    $q->whereIn('attrs.id', $r_cult)
                      ->where('attrs.group', 'cult');
                }
            );
        }
    
        // Фильтр по аналогам
        if (!empty($filter["analog"])) {
            $r_analog = $filter["analog"];
            $productsQuery->whereHas(
                'attrs',
                function ($q) use ($r_analog) {
                    $q->whereIn('attrs.id', $r_analog)
                      ->where('attrs.group', 'analog');
                }
            );
        }
    
        // Фильтр по веществам
        if (!empty($filter["sub"])) {
            $r_sub = $filter["sub"];
            $productsQuery->whereHas(
                'attrs',
                function ($q) use ($r_sub) {
                    $q->whereIn('attrs.id', $r_sub)
                      ->where('attrs.group', 'sub');
                }
            );
        }
    
        return $productsQuery->paginate(self::PAGE_COUNT);
    }
    public function selectedFilter($attrFilter) {
        $selectedFilter= [];
        if($attrFilter) {
            $filter = $this->setFilter($attrFilter);
         
        }
        if(!empty($filter["brand"])) {
            $selectedFilter["brand"] = $filter["brand"]  ? array_map('intval', $filter["brand"]) : [];
        }
        
        if(!empty($filter["cult"])) {
            $selectedFilter["cult"]  = $filter["cult"] ? array_map('intval', $filter["cult"]) : [];
        }
        if(!empty($filter["analog"])) {
            $selectedFilter["analog"]  = $filter["analog"] ? array_map('intval', $filter["analog"]) : [];
        }
        if(!empty($filter["sub"])) {
            $selectedFilter["sub"] = $filter["sub"]? array_map('intval', $filter["sub"]) : [];
        }
        
        return $selectedFilter;
    }

    public function searchProduct($search) {
        return Product::where('name_'.app()->getLocale(), 'LIKE', "%{$search}%")->paginate(20);
    }
    public function searchProductAjax($search) {
        $products = Product::where('name_'.app()->getLocale(), 'LIKE', "%{$search}%")->published()->get();
        $output = "";
        $searchArray = [];
        foreach ($products as $sea) {
            $searchArray[] = [
                'slug'=>$sea->slug,
                'image'=>$sea->image,
                'name'=>$sea->name,
            ];
        }
        return $searchArray;

    }
  
}
?>