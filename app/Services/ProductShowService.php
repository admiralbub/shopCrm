<?php
namespace App\Services;
 
use App\Interfaces\ProductShowInterface;
use App\Models\Brand;
use App\Models\Product; 
use App\Models\Category; 
use App\Models\Attr; 
use App\Models\AttrGroup; 
use Illuminate\Pagination\LengthAwarePaginator;
    


class ProductShowService implements ProductShowInterface {
    public function showProduct($slug) : Product {
        return Product::where('slug',$slug)->first();
    }
    public function attrProduct($product) {
        $list_attr=array();
        foreach( $product->attrs as $attr) {
            $list_attr[] = $attr->id;
        }
        $attr = Attr::whereIn("id",$list_attr)->with('attrGroup')->get();
        $attr = $attr->groupBy(function($item) {
            return $item->attrGroup ? $item->attrGroup->first()->name : '';
        });
        return $attr;
    }
}
?>