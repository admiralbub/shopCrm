<?php

namespace App\Actions\Admin\Category;
use App\Models\Category;
class UpdateSortAction
{
    /**
     * Create a new class instance.
     */
    public function execute(array $orderLists,$parent): Category
    {
        foreach($orderLists as $key => $item) {
            $categorie = Category::find(intval($item)); 
            $categorie->update([
                'sort'=>$key,
                'category_id'=>$parent
            ]);
            
        }
        return $categorie;
        
    }
}
