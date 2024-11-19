<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Interfaces\ProductInterface;
use App\Breadcrumbs\Breadcrumb;
class ViewProductController extends Controller
{
    private $breadcrumbs;
    private $productService;
    public function __construct(ProductInterface $productService, Breadcrumb $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
        $this->productService = $productService;
    }

    
    public function __invoke($slug) {
        $product =$this->productService->showProduct($slug);
        if (!$product) {
            abort(404);
        }
        $category = $product->categories->first->getRootCategory();
        $breadcrumbs = $this->breadcrumbs->breadCategoryProduct($category,$product);
        $attrs =$this->productService->attrProductShow($product);
        
        return view('products.show',['product'=>$product,'attrs'=>$attrs,'breadcrumbs'=>$breadcrumbs]);
    }
}
