<div class="sadbar_catalog">
    @if($category->count()!=0)
        <div class="categories">
            <strong class="fs-5">{{__('Product categories')}}</strong>
            <ul class="categories_links">
                @foreach($category as $child)
                    <li class="category_links-item">
                        <a href="{{route('product.category',$child->slug)}}">{{$child->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="filter-price mt-3">
        <strong class="fs-5">{{__('Price')}}</strong>
        <div class="price-input">
            <div class="field">
                <input type="number" class="input-min form-control" value="2500">
            </div>
            <div class="separator">-</div>
            <div class="field">
                <input type="number" class="input-max form-control" value="7500">
            </div>
        </div>
        <div class="slider">
            <div class="progress"></div>
        </div>
        <div class="range-input">
            <input type="range" class="range-min" min="0" max="10000" value="2500" step="100">
            <input type="range" class="range-max" min="0" max="10000" value="7500" step="100">
        </div>   
    </div>
    @if($brands->count())
        <div class="producer">
            <strong class="fs-5">{{__('Brand')}}</strong>
            <div class="producer_radio">
            
                @foreach($brands as $brand)
                    <div class="form-check">
                        <input class="form-check-input filter_brand_check" type="checkbox" name="brand" value="https://growex.market/products/express-sun/brand-126">
                        <label class="form-check-label">
                            <a href="https://growex.market/products/express-sun/brand-126" class="text-secondary">{{$brand->name}}</a>
                        </label>
                            
                    </div>
                @endforeach
        
            </div>
        </div>
    @endif
</div>