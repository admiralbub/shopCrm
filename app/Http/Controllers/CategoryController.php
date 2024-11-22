<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\App;
use App\Interfaces\ProductInterface;
use App\Breadcrumbs\Breadcrumb;
class CategoryController extends Controller
{
    private $breadcrumbs;

    private $productInt;

    public function __construct(ProductInterface $productInt, Breadcrumb $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
        $this->productInt = $productInt;
    }

    
    public function __invoke(Request $request,$slug, $filter = null) {
        $category = $this->productInt->getCategories($request->slug);

        if (!$category) {
            abort(404);
        }
        $breadcrumbs = $this->breadcrumbs->breadCategoryProduct($category);

        $productsCategory = $this->productInt->getProduct($category);
        $brands = $this->productInt->getBrand($productsCategory,$category);
        $price = $this->productInt->attrPrice($productsCategory,$category);

        $attrs = $this->productInt->attrProduct($productsCategory,$category);
        
        
        if($filter) {
            
            $products = $this->productInt->filterAttr($productsCategory,$filter);
          //  $products = $this->productInt->setFilter($productsCategory,$filter);
           $selectedFilter = $this->productInt->selectedFilter($filter);

            //dd($setFilterBrand );
        } else {
            if($request->get('sort')) {
                $products = $this->productInt->getSortProduct($productsCategory,$category,$request->get('sort'));
            } else if ($request->get('min_price') > 0 || $request->get('max_price') > 0) {
                $products = $this->productInt->filterPrice($request->get('min_price'),$request->get('max_price'), $productsCategory,$category);
            } else {
                $products = $this->productInt->getAllProduct($productsCategory,$category);
            }
        }
        
    
        return view('products.list',[
            'category'=>$category,
            'brands'=>$brands,
            'products'=>$products,
            'price'=>$price,
            'selectedFilter'=>$selectedFilter ?? "",
            'attrs'=>$attrs,
            'breadcrumbs'=>$breadcrumbs
        ]);

    }
}
