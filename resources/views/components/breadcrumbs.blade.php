<div class="py-5">
    <div class="breadcrumbs">
        <ul>
            <li><a href="{{route('index')}}">{{__('Home')}}</a></li>
            @foreach($breadcrumbs as $i => $breadcrumb)
                <li><a href="{{route('product.category',$breadcrumb['slug'])}}" @if(!isset($breadcrumb['name_product'])) @if($breadcrumbs->last()['id'] === $breadcrumb['id']) class="active" @endif @endif>{{ $breadcrumb['name'] }}</a></li>
            @endforeach
            @if(isset($breadcrumb['name_product']))
                <li><a href="{{route('product.view',$breadcrumb['name_slug'])}}" class="active">{{ $breadcrumb['name_product'] }}</a></li>
            @endif
        </ul>
    </div> 
</div>