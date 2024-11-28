<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Interfaces\ProductInterface;
class SearchController extends Controller
{
   private $productService;
   public function __construct(ProductInterface $productService)
   {
       $this->productService = $productService;
   }
   public function getProductByName(Request $request)
   {


        $search = $request->get('search');
      
        $products =$this->productService->searchProduct($search);

        return view(
            'search',
            compact('products','search')
        );
    }
    public function getProductByNameAjax(Request $request)
    {
        $search = $request->get('query');
        $searchArray =$this->productService->searchProductAjax($search);
        
        return $searchArray;

    }
}
