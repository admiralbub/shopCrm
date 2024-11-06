<x-layouts.app  
    :title="$category->meta_title"
    :descriptions="$category->meta_description"
    :keywords="$category->meta_keywords">
    <div class="container mb-5">
        
        <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>

        <div class="mt-2 category-heading">
            <h1 class="fs-2">{{$category->h1}}</h1>
            <div class="mt-4">
                @auth
                
                    @if(!empty(auth()->user()->permissions))
                        <a href="/admin/categories/{{$category->id}}/edit" target="_blank" class="primary">
                            <i class="bi bi-pencil-fill"></i>

                            <span>{{__('Edit')}}</span>
                        </a>
                    @endif
                @endif
            </div>
        </div>
        <div class="category-lists mt-3 mb-4">
            <div class="row">
                <div class="col col-lg-3 col-12">
                    <x-products.filter :brands="$brands" :price="$price" :selectedFilter="$selectedFilter" :attrs="$attrs" :category="$category->children"></x-products.filter>
                </div>
                <div class="col col-lg-9 col-12">
                    <div class="px-4">
                        <x-products.sort></x-products.sort>
                        @if($products)
                            <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-sm-2 row-cols-2 mb-30 card_prdoucts">
                                @foreach($products as $product)
                                    <x-products.product :product="$product"></x-products.product>
                                @endforeach
                            </div>
                        @else
                            <p class="fs-5">{{__('Unfortunately there are no products in this category')}}</p>
                        @endif
                        <div class="mt-3">
                            {{ $products->links() }}
                        </div>
                    </div>
                   
                </div>
            </div>  
        </div> 
    </div>

</x-layouts.app>