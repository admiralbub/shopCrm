<x-layouts.app  
    :title="$brand->meta_title"
    :descriptions="''"
    :keywords="''">


    <div class="show_brand container py-2">
        <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>
        <div class="row ">
            <div class="col col-lg-3 show_brand_img">
                <img src="{{asset($brand->images)}}">
            </div>
            <div class="col col-lg-9">
                <h1 class="fs-2">{{$brand->h1}}</h1>
                <div class="mt-4">
                     {!! $brand->description !!}
                </div>
                <div class="mt-4">
                    @auth
                
                        @if(!empty(auth()->user()->permissions))
                            <a href="/admin/brands/{{$brand->id}}/edit" target="_blank" class="primary">
                                <i class="bi bi-pencil-fill"></i>

                                <span>{{__('Edit')}}</span>
                            </a>
                        @endif
                    @endif
                </div>
            </div>
            
        </div>
        <div class="row show_brand-categories mt-5">
            @if($categories_gr->first())
                @foreach($categories_gr->first() as $category)
                    @if($category)
                        <div class="col-12 col-lg-3 brand_category">
                            <a href="{{route('product.category', [$category->slug,'brand-'.$brand->id])}}">
                                @if($category->img)
                                    <img src="{{ asset($category->img) }}" style="width: 50%;">
                                @endif
                                <span>{{ $category->name }}</span>
                            </a>  
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</x-layouts.app>