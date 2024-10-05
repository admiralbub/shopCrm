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
        <div id="slider"></div>
                               
        <div class="price_input">
            <input type="text" class="form-control" name="min_price" data-price="2980" value="2980" id="min" width="10%" style="">
            <input type="text" class="form-control" name="max_price" data-price="8464" value="8464" id="max" width="10%" style="">
                
            <input type="text" class="form-control" data-price="2980" value="2980" id="min_defult" width="10%" style="display: none;">
            <input type="text" class="form-control" data-price="8464" value="8464" id="max_defult" width="10%" style="display: none;">
        </div>
        <div id="slider-value1"></div>
        <div id="slider-value2"></div>
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