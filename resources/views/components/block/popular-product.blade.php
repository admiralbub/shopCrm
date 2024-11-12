@if(count($popularProducts)>0)
    <div class="main-products container">
        <div class="d-flex justify-content-between">
            <div class="main-products_heading">
                <h3 class="fs-1 ">
                    {!! __('Popular products') !!}
            
                </h3>
            </div>
           
        </div>
        <div class="swiper card_products card_products_main mt-3">
            <div class=" swiper-wrapper">
                @foreach($popularProducts as $product)
                    <x-products.slider-product :product="$product"/>
                @endforeach
            </div>
        </div>
    </div>
@endif