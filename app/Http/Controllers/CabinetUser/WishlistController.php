<?php

namespace App\Http\Controllers\CabinetUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\WishlistInterface;
class WishlistController extends Controller
{
    private $wishlist;
    public function __construct(WishlistInterface $wishlist) {
        $this->wishlist = $wishlist;
    }
    public function __invoke() {
        $wishlists = $this->wishlist->getWislist();
        return view('cabinet.wislist',['wishlists'=>$wishlists]);
    }
    public function addWislist(Request $request) {
        $wishlist = $this->wishlist->addWislist($request->id);
        if($wishlist == true) {
            $message = $this->wishlist->isMessageSuccess();
        } else {
            $message = $this->wishlist->isMessageFail();
        }
        return ["mess"=>$message];
    }
    public function count() {
        return ["count"=>$this->wishlist->countWislist()];
    }
    public function deleteWislist($id) {
        return $this->wishlist->deleteProductWislist($id);
    }
}
