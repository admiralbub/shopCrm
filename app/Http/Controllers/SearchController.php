<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class SearchController extends Controller
{
   public function getProductByName(Request $request)
   {


        $search = $request->get('search');
      
        $products = Product::where('name_'.app()->getLocale(), 'LIKE', "%{$search}%")->paginate(20);

        return view(
            'search',
            compact('products','search')
        );
    }
    public function getProductByNameAjax(Request $request)
    {
        $search = $request->get('query');
      
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
