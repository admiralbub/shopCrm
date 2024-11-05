<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\BrandInterface;
use App\Breadcrumbs\Breadcrumb;
class BrandController extends Controller
{

    private $brand;

    public function __construct(BrandInterface $brand, Breadcrumb $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
        $this->brand = $brand;
    }


    public function __invoke() {
        $brands = $this->brand->getListBrand();

        $bread = [
            "name"=>__("Brand"),
            "route"=>"product.brand.list"
        ];

        $breadcrumbs = $this->breadcrumbs->breadPage($bread);

        return view('brand.list',[
            'breadcrumbs'=>$breadcrumbs,
            'brands'=>$brands
        ]);
    }

    public function show(Request $request, $slug) {
        $brand = $this->brand->getBrandBySlug($slug);
        $categories_gr  = $this->brand->getBrandCat($brand);
        $bread = [
            "name"=>$brand->name,
            "slug"=>$brand->slug,
            "route"=>"product.brand.show",
            "parent" => [
                "name"=>__("Brand"),
                "route"=>"product.brand.list"
            ],
            
            
        ];

        $breadcrumbs = $this->breadcrumbs->breadPage($bread);

        return view('brand.show',['brand'=>$brand,'categories_gr'=>$categories_gr,'breadcrumbs'=>$breadcrumbs,]);
    }
}
