<?php
namespace App\Services;
 
use App\Interfaces\CompareInterface;

use App\Models\Product; 

use App\Models\Attr; 

class CompareService implements CompareInterface {

    public function addCompare(int $productId) {
    


        $comparisons_view = session()->get('compare');
        $count_comporison = 0;
    
        if (!$comparisons_view) {
            $comparisons_view = [
                $productId => [
                    'id' => $productId,
                ]
            ];
            session()->put('compare', $comparisons_view);  
            return true;
        } else {
            if (isset($comparisons_view[$productId])) {
                return false;

            } else {

                $comparisons_view[$productId] = [
                    'id' => $productId,
                           
                ];
                session()->put('compare', $comparisons_view);  
                return true;
            }
        }
        
        
    }
    public function getCompare() {

        $comparisons_view = session()->get('compare');
        $Productid = [];
        if ($comparisons_view) {
            foreach ($comparisons_view as $item) {
                $Productid[] = $item['id'];

            }
        }
        return Product::whereIn('id',$Productid)->orderBy('id', 'DESC')->get();
    }   
    public function attrProduct($products) {
        $list_attr=array();
        foreach( $products as $product) {
            foreach( $product->attrs as $attr) {
                $list_attr[] = $attr->id;
            }
        }
        $attr = Attr::whereIn("id",$list_attr)->get();
        $attr = $attr->groupBy(function($item) {
            return $item->group_text;
        });
        return $attr;
    }
    public function countCompare() {
        
        return count(session('compare', []));;
    }
    public function deleteProductCompare($id) {
        $comparisons = session()->get('compare');
        if ($comparisons) {
            foreach ($comparisons as $key => $item) {
                if ($item['id'] == $id) {
                    unset($comparisons[$key]);
                }
            }

            // Обновление сессии с обновленным массивом сравнения
            session()->put('compare', $comparisons);
        }
    }
    static public function isMessageSuccess() {
        $message = [
            "text"=>__('You have successfully added the product to your compare.'),
            "heading"=>__('Success'),
            "type"=>"success"
        ];
        return $message;
    }
    static public function isMessageFail() {
        $message = [
            "text"=>__('The item has already been added to your compare list.'),
            "heading"=>__('Fail'),
            "type"=>"fail"
        ];
        return $message;
    }
}