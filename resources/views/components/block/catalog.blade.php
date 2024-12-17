<div class="catalogs-index d-none d-lg-block">
    <ul class="catalogs-index_nav py-2">
        @foreach($categories->sortBy('sort') as $category)
            <li class="catalogs-index_nav item px-4 py-2">
                <a href="{{route('product.category',['slug'=>$category->slug])}}">
                    {{$category->name}}
                </a>
            </li>

        @endforeach
        
        
    </ul>
</div>