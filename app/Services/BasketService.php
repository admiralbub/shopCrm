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

    static public function priceProductGeneral ($prod) {
        $price_total = 0;
        $prod->wholesale_coef = ($prod->quantity >= 20 && $prod->wholesale_p10>0) ? $prod->wholesale_p10 : (($prod->quantity >= 5  && $prod->wholesale_p3>0) ? $prod->wholesale_p3 : $prod->price* $prod->pack_volume);
           if($prod->wholesale_p12  && $prod->wholesale_p11)  {
               if($prod->unit==1) {
                   if($prod->wholesale_p12<=$prod->quantity*$prod->pack_volume) {
                       $price_total = ($prod->quantity*$prod->pack_volume) * $prod->wholesale_p11;   
                   } else {
                       $price_total =  $prod->quantity * $prod->wholesale_coef;
                   }
               } else {
                   $price_total = $prod->quantity  * $prod->wholesale_coef;
               }
           } else if($prod->wholesale_p13  && $prod->wholesale_p14)  {
               if($prod->unit==2 || $prod->unit==3 || $prod->unit==4) {
                   if($prod->wholesale_p14<=$prod->quantity*$prod->pack_volume) {
                       $price_total = $prod->quantity * $prod->wholesale_p13;   
                   } else {
                       $price_total =  $prod->quantity * $prod->wholesale_coef;
                   }
               } else {
                   $price_total =  $prod->quantity * $prod->wholesale_coef;
               }

       } else {
            $price_total =  $prod->quantity  * $prod->wholesale_coef;
       }
           //////////////Подключаем скидку для товара
        if($prod->stocks) {
            $price_total =  $prod->quantity * ($prod->quantity >= 20 && $prod->wholesale_p10>0) ? $prod->wholesale_p10 : (($prod->quantity >= 5  && $prod->wholesale_p3>0) ? $prod->wholesale_p3 : $prod->price_stock* $prod->pack_volume);
        } else {
            $price_total =  $price_total;
        }
        return $price_total;
    }

    static public function showBasketOneClick(Product $product,$quantity) {
        $product = tap($product, function ($prod) use ($quantity) {
            $prod->quantity = $quantity;
            $prod->pack_volume = $prod->packs->first()->volume 
                ?? $prod->packs()->min('volume');
            $prod->pack_name = $prod->packs->first()->name 
                ?? $prod->packs()->min('title_' . app()->getLocale());
            $prod->price = ceil(self::priceProductGeneral($prod));
        });
        return $product ?? "";
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
                $prod->price =  ceil(self::priceProductGeneral($prod));
                    
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
                    $prod->price = ceil(self::priceProductGeneral($prod));    
                        
                        
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
            
            $products_order = self::showBasketDb(auth()->user()->id)->sum(
                function ($prod) {
                    return $prod->price*$prod->quantity;     
    
                }
            );  
            return $products_order;
        } else {
            
            $products_order = self::showBasketSession()->sum(
                function ($prod) {
                    return $prod->price*$prod->quantity;     
    
                }
            );  
            return $products_order;
           
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