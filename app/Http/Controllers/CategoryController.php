<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\App;
use App\Interfaces\CategoryInterface;
class CategoryController extends Controller
{
    protected $breadcrumbs;



    public function __construct(private CategoryInterface $categoryInt)
    {
        $this->breadcrumbs = collect();
    }

    protected function breadcrumbs($item)
    {
        if($item) {
            if ($item->parent) {
                $this->breadcrumbs($item->parent);
            }
            $this->breadcrumbs->push([
                'id' => $item->id,
                'slug' => $item->slug,
                'name' => $item->name
            ]);
        } else {
            abort(404);
        }
    
        return $this->breadcrumbs;
    }
    public function __invoke(Request $request,$slug, $filter = null) {
        $category = $this->categoryInt->getCategories($request->slug);

        if (!$category) {
            abort(404);
        }
        $breadcrumbs = $this->breadcrumbs($category);

        $productsCategory = $this->categoryInt->getProduct($category);
        $brands = $this->categoryInt->getBrand($productsCategory,$category);
        $price = $this->categoryInt->attrPrice($productsCategory,$category);

        $attrs = $this->categoryInt->attrProduct($productsCategory,$category);
        
        
        if($filter) {
            
            $selected = $this->categoryInt->filterAttr($filter);
            $products = $this->categoryInt->setFilter($productsCategory,$filter);
            $selectedFilter = $this->categoryInt->selectedFilter($selected);

            //dd($setFilterBrand );
        } else {
            if($request->get('sort')) {
                $products = $this->categoryInt->getSortProduct($productsCategory,$category,$request->get('sort'));
            } else if ($request->get('min_price') > 0 || $request->get('max_price') > 0) {
                $products = $this->categoryInt->filterPrice($request->get('min_price'),$request->get('max_price'), $productsCategory,$category);
            } else {
                $products = $this->categoryInt->getAllProduct($productsCategory,$category);
            }
        }
        
    
        return view('products.list',[
            'category'=>$category,
            'brands'=>$brands,
            'products'=>$products,
            'price'=>$price,
            'selectedFilter'=>$selectedFilter ?? '',
            'attrs'=>$attrs,
            'breadcrumbs'=>$breadcrumbs
        ]);

    }
}
