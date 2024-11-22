<div class="sadbar_catalog">
    @if(count($category)!=0)
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
                        <input type="text" class="input-min form-control js-price-down" value="1" name="min_price" data-min="1">
                    </div>
                    <div class="separator">-</div>
                    <div class="field">
                        <input type="text" class="input-max form-control js-price-up" value="{{max($price)}}" name="max_price" data-max="{{max($price)}}">
                    </div>
                </div>
                <div class="mt-2 d-grid gap-2">
                    <button class="btn btn-primary">{{__('Apply')}}</button>
                </div>
                
            </form>
            
            
        </div>
    @endif
    @if($attrs)
        @foreach ($attrs as $groupName => $attributes)
            <div class="producer">
                <strong class="fs-5">{{$groupName}}</strong>
                <div class="producer_radio">
                
                    @foreach ($attributes as $attr) 
                
                        <div class="form-check mb-3 d-flex">
                            <input class="form-check-input filter_attr_check" type="checkbox" name="brand" value="{{filterUrlAttr(\Request::url(), $attr->id, $attr->group)}}" {{isset($selectedFilter[$attr->group]) ? in_array($attr->id,$selectedFilter[$attr->group] ) ? 'checked' : "" : ""}}>
                            <label class="form-check-label">
                                <a href="{{filterUrlAttr(\Request::url(), $attr->id, $attr->group)}}" class="text-secondary">{{$attr->name}}</a>

                            </label>
                                    
                        </div>
                    @endforeach
            
                </div>
            </div>
        @endforeach
    @endif
    
    @if($brands->count() != 0)
        <div class="producer">
            <strong class="fs-5">{{__('Brand')}}</strong>
            <div class="producer_radio">
            
                @foreach($brands as $brand)
             
                    <div class="form-check d-flex mt-3">
                        <input class="form-check-input filter_brand_check" type="checkbox" name="brand" value="{{filterUrlAttr(\Request::url(),$brand->id,'brand')}}" {{isset($selectedFilter["brand"]) ? in_array($brand->id,$selectedFilter["brand"] ) ? 'checked' : "" : ""}}>
                        <label class="form-check-label">
                            <a href="{{filterUrlAttr(\Request::url(),$brand->id,'brand')}}" class="text-secondary">{{$brand->name}}</a>
                        </label>
                            
                    </div>
                @endforeach
        
            </div>
        </div>
    @endif
</div>