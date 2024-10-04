<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class CategoryController extends Controller
{
    protected $breadcrumbs;

    public function __construct()
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
    public function __invoke(Request $request) {
        $category = Category::where('slug', $request->slug)->published()->first();
        if (!$category) {
            abort(404);
        }
        $breadcrumbs = $this->breadcrumbs($category);
        $product_ids = $category->products()
            ->get()
            ->pluck('id');
        $products = Product::whereIn('id', $product_ids)->orderBy("status","ASC")->published()->get();
        return view('products.list',[
            'category'=>$category,
            'products' => $products,
            'breadcrumbs'=>$breadcrumbs
        ]);

    }
}
