<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ViewProductController extends Controller
{
    protected $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = collect();
    }

    protected function breadcrumbs($item,$product)
    {
        if($item) {
            if ($item->parent) {
                $this->breadcrumbs($item->parent,$product);
            }
            $this->breadcrumbs->push([
                'id' => $item->id,
                'slug' => $item->slug,
                'name' => $item->name,
                'name_product'=>$product->name,
                'name_slug'=>$product->slug,
            ]);
        } else {
            abort(404);
        }
        

       

        return $this->breadcrumbs;
    }
    public function __invoke($slug) {
        $product = Product::where('slug',$slug)->first();
        if (!$product) {
            abort(404);
        }
        $category = $product->categories->first->getRootCategory();
        $breadcrumbs = $this->breadcrumbs($category,$product);
        return view('products.show',['product'=>$product,'breadcrumbs'=>$breadcrumbs]);
    }
}
