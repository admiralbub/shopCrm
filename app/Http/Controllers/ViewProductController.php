<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Interfaces\ProductInterface;
use App\Breadcrumbs\Breadcrumb;
use App\Interfaces\FeedbackInterface;
class ViewProductController extends Controller
{
    private $breadcrumbs;
    private $productService;
    private $feedback;
    public function __construct(ProductInterface $productService, Breadcrumb $breadcrumbs,FeedbackInterface $feedback)
    {
        $this->breadcrumbs = $breadcrumbs;
        $this->productService = $productService;
        $this->feedback = $feedback;
    }

    
    public function __invoke($slug) {
        $product =$this->productService->showProduct($slug);
        if (!$product) {
            abort(404);
        }
        $category = $product->categories->first->getRootCategory();
        $breadcrumbs = $this->breadcrumbs->breadCategoryProduct($category,$product);
        $attrs =$this->productService->attrProductShow($product);
        $feedbacks =$this->feedback->listFeedback($product->id);

        return view('products.show',['product'=>$product,'attrs'=>$attrs,'breadcrumbs'=>$breadcrumbs,'feedbacks'=>$feedbacks]);
    }
}
