<?php
namespace App\Services;
 
use App\Interfaces\BasketInterface;
use App\Models\Brand;
use App\Models\Product; 
use App\Models\Basket; 
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Actions\Basket\AddBasketAction;
use App\Actions\Basket\UpdateBasketAction;

use App\Actions\Basket\DeleteAction;
use Illuminate\Pagination\LengthAwarePaginator;
    


class BasketService implements BasketInterface {
    static public function isAuth() {
        return Auth::check();
    }
    static public function showBasketDb($user_id) {
        $id_array = Basket::where('user_id',auth()->user()->id)->select("product_id")->get()->toArray();
        $products = Product::whereIn('id', $id_array)->get();
            //$is_kobzar = isKobzarAuth($id_array);
           // dd($is_kobzar);

        $products = $products->map(
            function ($prod) {
                $data = Basket::where('user_id',auth()->user()->id)->where('product_id',$prod->id)->first();
                $prod->quantity = $data->quantity;
                $prod->id_basket = $data->id;
                $prod->pack_volume =$prod->packs->find($data->pack_id)->volume ?? $prod->packs()->min('volume');
                $prod->pack_name = $prod->packs->find($data->pack_id)->name ?? $prod->packs()->min('title_'.app()->getLocale());
                $prod->price =  ceil($prod->price *$prod->pack_volume);
                    
                ////////////
                return $prod;
            }
        );
        return $products ?? "";
    }
    static public function showBasketSession() {
        $cart = session()->get('cart');
        if($cart) {
            $id_array = array();
            foreach ($cart as $item) {
                $id_array[]=$item['id'];
            }
            $products = Product::whereIn('id', $id_array)->get();
            $products = $products->map(
                function ($prod) use ($cart) {
                    $data = json_decode(json_encode($cart[$prod->id]), true);



                    $prod->quantity = $data['quantity'];
                    $prod->pack_id = $data['pack_id'];
                    $prod->pack_volume =$prod->packs->find($data['pack_id'])->volume ?? $prod->packs()->min('volume');
                    $prod->pack_name = $prod->packs->find($data['pack_id'])->title ?? $prod->packs()->min('name_'.app()->getLocale());
                    $prod->price = ceil($prod->price*$prod->packs->find($data['pack_id'])->volume);    
                        
                        
                     ////////////
                    return $prod;
                }
            );
        }
        return $products ?? "";
    }

    static public function sessionAddBasket($productId, $packid,$productQuantity) {
        $count = 0;

        $cart = session()->get('cart');  
        if (!$cart) {
            $cart = [
                $productId => [
                    'id' => $productId,
                    'quantity' => $productQuantity,
                    'pack_id'=>$packid,
    
                ]
            ];
        } else {
            // Если товар уже есть в корзине, увеличьте его количество.
            if (isset($cart[$productId])) {
                // $cart[$productId]['quantity']+=$productQuantity;
                $cart[$productId]['quantity']+=$productQuantity;
                if ($cart[$productId]['pack_id'] != $packid) {
                    $cart = [
                        $productId => [
                            'id' => $productId,
                            'quantity' => $productQuantity,
                            'pack_id'=>$packid,
                        ]
                    ];      
                }
            } else {
                 // В противном случае добавьте товар в корзину.
                $cart[$productId] = [
                    'id' => $productId,
                    'quantity' => $productQuantity,
                    'pack_id'=>$packid,
                ];
            }
        }
        session()->put('cart', $cart);  
        $cart = session()->get('cart');  
        foreach ($cart as $item) {
            if (is_array($item)) {
                $count += $item['quantity'] ?? 0;
            } else {
                $count += $item->quantity ?? 0;
            }
        }
        

        return $count;

    }
    static public function dbAddBasket($user_id, $productId, $packid,$productQuantity) {
        //Если товар уже есть в корзине, то мы просто увеличем кол.
        $isBasket = Basket::where('user_id',$user_id)->where('product_id',$productId)->first();
        if($isBasket) {
            $quantity = $isBasket->quantity + $productQuantity;
            (new UpdateBasketAction())->execute($isBasket,$quantity);
        } else {
            (new AddBasketAction())->execute($user_id,$productId, $packid,$productQuantity);
        }
        return  Basket::where('user_id',auth()->user()->id)->sum("quantity");
    }
    static public function isMessageSuccess() {
        
        $message = [
            "success"=>__('You have successfully added the product to your cart.')
        ];
        return $message;
    }
    static public function get_Count_Goods($isAuth) {
        $count=0;
        if($isAuth) {
            $count = Basket::where('user_id',auth()->user()->id)->sum("quantity");
        } else {
            $cart = session()->get('cart');  
            if($cart) {
                foreach ($cart as $item) {
                    if (is_array($item)) {
                        $count += $item['quantity'] ?? 0;
                    } else {
                        $count += $item->quantity ?? 0;
                    }
                } 
            }
        }
        return $count;
    }
    static public function totalBasket($isAuth) {
        $_count=0;
        if($isAuth) {
            $baskets = Basket::where('user_id',auth()->user()->id)->get();
            foreach ($baskets as $basket) {
                $_count+=ceil(($basket->products->price * $basket->products->packs->first()->volume))*$basket->quantity;
            }
            return $_count;
        } else {
            
            $cart = session()->get('cart');  
            if($cart) {
                foreach ($cart as $item) {
                    $product = Product::find($item['id'])->first();
                    $_count+=ceil(($product->price * $product->packs->find($item['pack_id'])->volume))*$item['quantity'];
                }
            }
           
            return $_count;
           
        }
    }
    static public function deleteProductBasket($isAuth,$id) {
        if($isAuth) {
            $isBasket = Basket::where('user_id',auth()->user()->id)->where('product_id',$id)->first();
            (new DeleteAction())->execute($isBasket);
        } else {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }
    }
    static public function quantity($isAuth,$product_id,$quantity) {
        if($isAuth) {
            $isBasket = Basket::where('user_id',auth()->user()->id)->where('product_id',$product_id)->first();
            $count = (new UpdateBasketAction())->execute($isBasket,$quantity);
        } else {
            $cart = session()->get('cart');
            if(isset($cart[$product_id])) {
                $cart[$product_id]['quantity'] = $quantity;
                session()->put('cart', $cart);
            }   

            foreach ($cart as $item) {
                if (is_array($item)) {
                    $count += $item['quantity'] ?? 0;
                } else {
                    $count += $item->quantity ?? 0;
                }
            }
        }
        return $count;
    }
    static public function clearBasket($isAuth) {
        if($isAuth) {
            $clear_cart = Basket::where("user_id", auth()->user()->id);
            return $clear_cart->delete();
        } else {
            return session()->forget('cart');
        }
    }
    
}