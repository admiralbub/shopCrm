

<li class="fs-6">
    <a href="{{route('product.category',['slug'=>$childCategory->slug])}}" class="sub_main">
        {{$childCategory->name}}
    </a>
    <ul  class="catalog-submenu--list_sub">
        @foreach ($childCategory->categories->sortBy('sort') as $childCategory2)
            <li>
                <a href="{{route('product.category',['slug'=>$childCategory2->slug])}}">
                    {{$childCategory2->name}}
                </a>
                                                                        
            </li>
        @endforeach 
    </ul>
</li>

                                            
