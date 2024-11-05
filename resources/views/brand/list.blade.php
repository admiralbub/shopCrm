<x-layouts.app  
    :title="__('Brand')"
    :descriptions="''"
    :keywords="''">


    <div class="container py-2">
        <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>
        <div class="row">
            <h1 class="fs-2">{{__('Brand')}}</h1>
        </div>
        <div class="row brands mt-5">
            @foreach($brands as $brand)
                <div class="brand col-xs-12 col-lg-4">
                    <a href="{{route('product.brand.show',['slug'=>$brand->slug])}}">
                        <img src="{{asset($brand->images)}}" alt="">
                    </a>
                    
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            {{ $brands->links() }}
        </div>
    </div>
</x-layouts.app>