<div class="catalog d-lg-block d-none ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col col-lg-3">
                <div class="catalog-item py-3 px-2  ">
                    <div class="d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <span>{{__('All categories')}}</span>
                    </div>
                       

                    <nav class="catalog-category-menu">
                        <ul class="catalog-category-menu__products">
                            @foreach($categories->sortBy('sort') as $category)
                                 @if($category->children()->count() > 0)

                                    <li class="has-dropdown">
                                       
                                        <a href="{{route('product.category',['slug'=>$category->slug])}}">
                                            {{$category->name}}
                                        </a>
                                        
                                        <div class="catalog-submenu">
                                            <div class="top-navigation">
                                                
                                                @foreach ($category->childrenCategories->sortBy('sort') as $childCategory)
                                                    <div class="column column-{{$loop->iteration}}">
                                                        <ul class="catalog-submenu--list">
                                                            <x-layouts.child-category :childCategory="$childCategory"></x-layouts.child-category>
                                                       </ul>
                                                    </div>
                                                            
                                                @endforeach
                                               
                                            </div>
                                            
                                        </div>

                                            
                                    </li>

                                @else
                                    <li>
                                        <a href="{{route('product.category',['slug'=>$category->slug])}}">
                                            {{$category->name}}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                            
                        </ul>
                    </nav>
                </div>
                    
            </div>
            <div class="col col-lg-7">
                <x-layouts.search></x-layouts.search>
            </div>
            <div class="col col-lg-2">
                <x-layouts.catalog-action></x-layouts.catalog-action>
            </div>
        </div>
    </div>
</div>