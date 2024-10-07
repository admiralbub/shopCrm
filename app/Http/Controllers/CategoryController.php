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
        $categoryInt = App::make(CategoryInterface::class); 
        $category = $categoryInt->getCategories($request->slug);

        if (!$category) {
            abort(404);
        }
        $breadcrumbs = $this->breadcrumbs($category);

        $product = $categoryInt->getProduct($category);
        $brands = $categoryInt->getBrand($product,$category);
        $products = $categoryInt->getSortProduct($product,$category,$request->get('sort'));
        
        return view('products.list',[
            'category'=>$category,
            'brands'=>$brands,
            'products'=>$products->paginate(22),
            'breadcrumbs'=>$breadcrumbs
        ]);

    }
}
