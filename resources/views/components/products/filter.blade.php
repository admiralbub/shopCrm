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
    @if(count($price))
        <div class="filter-price mt-3">
            <strong class="fs-5">{{__('Price')}}</strong>
            <form action="#" method="get">
                <div class="filter-price__slider js-price-range"></div>
                <div class="filter-price__row">
                    <div class="field">
                        <input type="text" class="input-min form-control js-price-down" value="{{intval(min($price))}}" name="min_price" data-min="{{intval(min($price))}}">
                    </div>
                    <div class="separator">-</div>
                    <div class="field">
                        <input type="text" class="input-max form-control js-price-up" value="{{intval(max($price))}}" name="max_price" data-max="{{intval(max($price))}}">
                    </div>
                </div>
                <div class="mt-2 d-grid gap-2">
                    <button class="btn btn-primary">{{__('Apply')}}</button>
                </div>
                
            </form>
            
            
        </div>
    @endif
    @if($attrs->count())
        @foreach ($attrs as $groupName => $attributes)
            <div class="producer">
                <strong class="fs-5">{{$groupName}}</strong>
                <div class="producer_radio">
                
                    @foreach ($attributes as $attr) 
                        <div class="form-check mb-3 d-flex">
                            <input class="form-check-input filter_brand_check" type="checkbox" name="brand" value="{{filter_url(\Request::url(), $attr->id, $attr->attrGroup->first()->slug)}}" {{ isset($selectedFilter["attr_group"]) && in_array($attr->attrGroup->first()->id, $selectedFilter["attr_group"]) ? 'checked' : '' }}>
                            <label class="form-check-label">
                                <a href="{{filter_url(\Request::url(), $attr->id, $attr->attrGroup->first()->slug)}}" class="text-secondary">{{$attr->name}}</a>

                            </label>
                                    
                        </div>
                    @endforeach
            
                </div>
            </div>
        @endforeach
    @endif
    
    @if($brands->count())
        <div class="producer">
            <strong class="fs-5">{{__('Brand')}}</strong>
            <div class="producer_radio">
            
                @foreach($brands as $brand)
                    <div class="form-check d-flex mt-3">
                        <input class="form-check-input filter_brand_check" type="checkbox" name="brand" value="{{filter_url(\Request::url(),$brand->id,'brand')}}" {{ isset($selectedFilter["brand"]) && in_array($brand->id, $selectedFilter["brand"]) ? 'checked' : '' }}>
                        <label class="form-check-label">
                            <a href="{{filter_url(\Request::url(),$brand->id,'brand')}}" class="text-secondary">{{$brand->name}}</a>
                        </label>
                            
                    </div>
                @endforeach
        
            </div>
        </div>
    @endif
</div>