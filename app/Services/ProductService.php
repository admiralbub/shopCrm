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
        $attr = Attr::whereIn("id",$list_attr)->with('attrGroup')->get();
        $attr = $attr->groupBy(function($item) {
            return $item->attrGroup ? $item->attrGroup->first()->name : '';
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
        $attr = Attr::whereIn("id",$list_attr)->with('attrGroup')->get();
        $attr = $attr->groupBy(function($item) {
            return $item->attrGroup ? $item->attrGroup->first()->name : 'Без группы';
        });
        return $attr;
    }
    public function filterAttr($filter) {
        $filter_str = explode('/',$filter);
                
        //dd($filter_str);
        $filter = array();
        if (sizeof($filter_str)) {
            foreach ($filter_str as $key=>$str) {
                if ($str!='') {
                    $val= explode('-',$str);
                    if (isset($val[1])) {
                        $filter[$val[0]] = explode('_', $val[1]);
                    }
                }
 
            }
        }
        return $filter;
    }
    public function selectedFilter($attrFilter) {
        $selectedFilter = [];
        if(!empty($attrFilter["brand"])) {
            $selectedFilter = $attrFilter["brand"]  ? array_map('intval', $attrFilter["brand"]) : [];
        } 
        $selectedFilter[] = $attrFilter;
        return $selectedFilter;
    }
    public function setFilter($products,$filter) {
        $filter_str = str_replace('-'.explode('-', $filter)[1], '', $filter);
        if($filter_str == "brand") {
            preg_match_all('/\d+/', $filter, $matches);
            $brand_ids = $matches[0];
               
            return $products = $products->whereHas(
                'brand',
                function ($q) use ($brand_ids) {
                    $q->whereIn('id', $brand_ids);
                }
            )->paginate(self::PAGE_COUNT);
        } else {
            $filter_slug = str_replace('-'.explode('-', $filter)[1], '', $filter);
            $id_group = AttrGroup::where('slug',$filter_slug)->first();
            return $products = $products->whereHas(
                'attrs',
                function ($q) use ($id_group) {
                    $q->whereIn('group_id', $id_group);
                }
            )->paginate(self::PAGE_COUNT);
        }
            
    }
}
?>