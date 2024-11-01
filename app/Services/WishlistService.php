<?php
namespace App\Services;
 
use App\Interfaces\WishlistInterface;
use App\Models\User;
use App\Models\Product; 
use App\Models\Wishlist;
use App\Actions\Wislist\addWislistAction;
use App\Actions\Wislist\deleteWislistAction;
use Illuminate\Pagination\LengthAwarePaginator;
    


class WishlistService implements WishlistInterface {
    public const PAGE_COUNT = 10;
    public function addWislist(int $productId) {
        $authId = auth()->user()->id;
        $isWishlist = Wishlist::where('user_id',$authId)->where('product_id',$productId)->count();
        if ($isWishlist == 0) {
            (new addWislistAction())->execute($authId,$productId);
            return true;
        } else {
            return false;
        }
       

    }
    public function deleteProductWislist($id) {
        $wishition = Wishlist::findOrFail($id);
        return (new deleteWislistAction())->execute($wishition);
    }
    public function getWislist() {
        return Wishlist::where('user_id',auth()->user()->id)->paginate(self::PAGE_COUNT);
    }
    public function countWislist() {
        if(auth()->check()) {
            return $isWishlist = Wishlist::where('user_id',auth()->user()->id)->count();
        } else {
            return 0;
        }
    }
    static public function isMessageSuccess() {
        
        $message = [
            "text"=>__('You have successfully added the product to your favorites.'),
            "heading"=>__('Success'),
            "type"=>"success"
        ];
        return $message;
    }
    static public function isMessageFail() {
        
        $message = [
            "text"=>__('The item has already been added to your wish list.'),
            "heading"=>__('Fail'),
            "type"=>"fail"
        ];
        return $message;
    }
}