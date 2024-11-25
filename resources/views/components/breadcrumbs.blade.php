<div class="pt-5 pb-3">
    <div class="breadcrumbs">
        <ul>
            <li><a href="{{route('index')}}">{{__('Home')}}</a></li>
            @if(isset($breadcrumbs[0]['type']) && !empty($breadcrumbs[0]['type'] == "page"))
                @foreach($breadcrumbs as $breadcrumb)
                    @if (isset($breadcrumb['parent']))
                        <li><a href="{{route($breadcrumb['parent']['route'])}}">{{ $breadcrumb['parent']['name'] }}</a></li>
                        <li><a href="{{route($breadcrumb['route'], ['slug' => $breadcrumb['slug']])}}" class="active">{{ $breadcrumb['name'] }}</a></li>
                    @else
                        <li><a href="{{ $breadcrumb['slug'] ? route($breadcrumb['route'], ['slug' => $breadcrumb['slug']]) : route($breadcrumb['route']) }}" class="active">{{ $breadcrumb['name'] }}</a></li>
                    @endif
                    
                    
                @endforeach
            @else
                @foreach($breadcrumbs as $i => $breadcrumb)
                    <li><a href="{{route('product.category',$breadcrumb['slug'])}}" @if(!isset($breadcrumb['name_product'])) @if($breadcrumbs->last()['id'] === $breadcrumb['id']) class="active" @endif @endif>{{ $breadcrumb['name'] }}</a></li>
                    
                @endforeach
                @if(isset($breadcrumb['name_product']))
                    <li><a href="{{route('product.view',$breadcrumb['name_slug'])}}" class="active">{{ $breadcrumb['name_product'] }}</a></li>
                @endif
            @endif
        </ul>
    </div> 
</div>