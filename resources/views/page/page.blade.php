<x-layouts.app  
    :title="$page->meta_title"
    :descriptions="$page->meta_description"
    :keywords="$page->meta_keywords">
    <div class="container py-2">
        <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>
        <h1 class="fs-3">{{ $page->h1 }}</h1>
        <div class="row mt-4 mb-4">
            <div class="col-12 col-lg-8">
                {!! preg_replace('#<h1([^>]*)>(.*)</h1>#m','<h2$1>$2</h2>', $page->description) !!}
            </div>
            <div class="col-12 col-lg-4">
                <img src="{{asset($page->img)}}" alt="">
            </div>
        </div>
        @if(count($page->products)>0)
            <div class="mt-4">
                <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-sm-2 row-cols-2 mb-30 card_products">
                    @foreach($page->products as $product)
                        <x-products.product :product="$product"></x-products.product>
                    @endforeach
                </div>
            </div>
            
        @endif
    </div>
</x-layouts.app>