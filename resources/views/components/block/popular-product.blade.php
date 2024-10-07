<div class="main-products container">
    <div class="d-flex justify-content-between">
        <div class="main-products_heading">
            <h3 class="fs-2 ">
                {!! __('Popular products') !!}
        
            </h3>
        </div>
        <div class="main-products_link">
            <a href="#">
                {{__('All product')}}
            </a>
        </div>
    </div>
    <div class="swiper card_prdoucts card_prdoucts_main">
        <div class=" swiper-wrapper">
            <x-products.slider-product/>
            <x-products.slider-product/>
            <x-products.slider-product/>
            <x-products.slider-product/>
            <x-products.slider-product/>
            <x-products.slider-product/>
        </div>
    </div>
</div>