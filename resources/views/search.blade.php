<x-layouts.app  
    :title="__('Search')"
    :descriptions="__('Search')"
    :keywords="__('Search')">

    <div class="container mb-5 mt-5">
        <div class="row">
            <h1 class="fs-2">{{__('Search')}} - {{$search}}</h1>
        </div>
        <div class="mt-3">
            @if($products)
                <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-sm-2 row-cols-2 mb-30 card_products">
                    @foreach($products as $product)
                        <x-products.product :product="$product"></x-products.product>
                    @endforeach
                </div>
            @else
                <p class="fs-5">{{__('Unfortunately there are no products in this category')}}</p>
            @endif    
            {!! $products->links() !!}
        </div>
       
    </div>
</x-layouts.app>