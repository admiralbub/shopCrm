<div class="py-5">
    <div class="breadcrumbs">
        <ul>
            <li><a href="{{route('index')}}">{{__('Home')}}</a></li>
            @foreach($breadcrumbs as $i => $breadcrumb)
                <li><a href="{{route('product.category',$breadcrumb['slug'])}}" @if($breadcrumbs->last()['id'] === $breadcrumb['id']) class="active" @endif>{{ $breadcrumb['name'] }}</a></li>
            @endforeach
        </ul>
    </div> 
</div>