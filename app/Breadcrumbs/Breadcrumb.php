<?php
namespace App\Breadcrumbs;
use App\Models\Category;
use App\Models\Product;
class Breadcrumb {

    protected $breadcrumbs;

    public function __construct() {
        $this->breadcrumbs = collect();
    }

    public function breadCategoryProduct($item,$product=null)
    {
        if($item) {
            if ($item->parent) {
                if(!empty($product)) {
                    $this->breadCategoryProduct($item->parent,$product);
                } else {
                    $this->breadCategoryProduct($item->parent,$product=null);
                }
                
            }
            
            if(!empty($product)) {
                $this->breadcrumbs->push([
                    'id' => $item->id,
                    'slug' => $item->slug,
                    'name' => $item->name,
                    'name_product'=>$product->name,
                    'name_slug'=>$product->slug,
                ]);
            } else {
                $this->breadcrumbs->push([
                    'id' => $item->id,
                    'slug' => $item->slug,
                    'name' => $item->name
                ]);
            }   
            
        } else {
            abort(404);
        }
    
        return $this->breadcrumbs;
    }

    public function breadPage($item)
    {

        if (is_array($item)) {
            $parent = null;
            if (isset($item['parent'])) {
                $parent = [
                    "name" => $item['parent']['name'], 
                    "route" => $item['parent']['route'], 
                ];
            }
            $this->breadcrumbs->push([
                "name" => $item['name'],
                "route" => $item['route'],
                "slug" => $item['slug'] ?? "",
                "parent" => $parent, 
                "type" => 'page'
            ]);
        }
    
        return $this->breadcrumbs;
    }

    
}

?>