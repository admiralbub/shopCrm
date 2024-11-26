<div class="col card_product position-relative">
    <div class="card_product-img" onclick="document.location='{{route('product.view',$product->slug)}}'">
        <img src="{{ asset($product->image)}}" alt="">

        
    </div>
    @if($product->price_stock)
        <div class="market_sale">{{__('Stock')}}</div>
    @endif
    <div class="card_product-managment" >
        <div class="card_product-managment_scale" id="AddCompareList">
            <button class="button_scale_card" data-id="{{$product->id}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
                </svg>                          
            </button>
        </div>
        <div class="card_product-managment_heart" id="AddWislistList">
            <button class="button_heart_card" data-id="{{$product->id}}" data-auth="{{auth()->check() ? '1' : '0'}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </button>
        </div>    
    </div>
    <div class="card_product-heading">
        <a href="{{route('product.view',$product->slug)}}">
            {{$product->name}}
        </a>
    </div>
    <div class="card_product-rating" onclick="document.location='{{route('product.view',$product->slug)}}'" style="cursor:pointer;">
        <div class="card_product-rating-icon">
            <div class="rating" data-rate-value="{{$product->feedback->avg('rating')}}"></div>
        </div>
        <div class="card_product-rating-count">
            <div class="count-text">
                {{$product->feedback->count()}} {{__('Reviews')}}
            </div>
        </div>
    </div>
    @if ($product->stocks)
        <div class="card_product-oldprice">
            
            <span>{{ ceil(($product->packs->count() > 0 ? $product->packs->first()->volume : 1)  * $product->price) }} {{__("uah")}}</span>
            
        </div>
    @endif 
    <div class="card_product-price @if(!$product->stocks) mt-2 @endif">
        @if ($product->stocks)
            {{ ceil(($product->packs->count() > 0 ? $product->packs->first()->volume : 1)  * $product->price_stock) }} {{__("uah")}}
        @else
            {{ ceil(($product->packs->count() > 0 ? $product->packs->first()->volume : 1)  * $product->price) }} {{__("uah")}}
        @endif     
    
    </div>
    @if($product->status_available)
        <div class="card_product-button mt-3">
            <button type="button" class="btn btn-primary" id="addBasketList" data-id="{{$product->id}}"  data-packid="{{$product->packs->first()->id}}">
                {{__('Add to cart')}}
            </button>
        </div>
    @endif
 </div>