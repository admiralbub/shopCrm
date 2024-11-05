<li class="submenu_mob-item">
    <a href="{{route('product.category',['slug'=>$childCategory->slug])}}" >
        <span>{{$childCategory->name}}</span>
    </a>
    @if($childCategory->children()->count() > 0)
        <button class="icon-submenu2_click button-submenu_click" data-id="{{$childCategory->id}}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
                                        
        </button>
    @endif
    @if($childCategory->children()->count() > 0)
        <ul  class="submenu_mob" id="submenu_mob{{$childCategory->id}}">
            @foreach ($childCategory->categories->sortBy('sort') as $childCategory2)
                <li class="submenu_mob-item">
                    <a href="{{route('product.category',['slug'=>$childCategory2->slug])}}">
                        {{$childCategory2->name}}
                    </a>
                                                                            
                </li>
            @endforeach 
        </ul>
    @endif
</li>