<div class="catalog-mob d-lg-none d-block" >
    <div class="catalog-mob--header d-flex  justify-content-between">
        <div class="catalog-mob--logo">
            <a href="{{route('index')}}">
                <img src="{{asset('images/logo_black.svg')}}" width="150px">
            </a>
        </div>
        <div class="catalog-mob--language  d-flex">
            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="text-uppercase">{{ LaravelLocalization::getCurrentLocale()}}</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
                      
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL('ua', null, [], true) }}">
                        <span>Українська</span>
                     </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL('ru', null, [], true) }}">
                        <span>Русский</span>
                     </a>
                </li>
            </ul>
         </div>
    </div>
    <div class="catalog-mob--close">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </div>

    <div class="catalog-mob--content">
        <button class="button-mob_category" id="menu_categeryMob-open">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
            </svg>
                  
            {{__('All categories')}}
        </button>
        <div class="catalog-mob--content_menu" id="categor_mob">
            <ul>
                @foreach($categories->sortBy('sort') as $category)
                    @if($category->children()->count() > 0)
                        <li class="has-dropdown">
                            <a href="{{route('product.category',['slug'=>$category->slug])}}">
                                
                                <span>{{$category->name}}</span>
                            </a>
                            <button class="icon-submenu_click button-submenu_click" data-id="{{$category->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                                    
                            </button>
                            @foreach ($category->childrenCategories->sortBy('sort') as $childCategory)
                                <ul class="submenu_mob" id="submenu_mob{{$category->id}}">
                                    <x-layouts.child-category-mob :childCategory="$childCategory"></x-layouts.child-category-mob>
                                </ul>
                            @endforeach
                        </li>
                       
                    @else
                        <li class="submenu_mob-item">
                            <a href="{{route('product.category',['slug'=>$category->slug])}}">
                                
                                <span>{{$category->name}}</span>
                            </a>
                        </li>
                    @endif
                @endforeach

            </ul>
        </div>
        <div class="catalog-mob--content_list">
            <ul>
                <li><a href="{{route('index')}}">{{__('Home')}}</a></li>
                <li><a href="#">{{__('Stocks')}}</a></li>
                <li><a href="{{route('product.brand.list')}}">{{__('Brand')}}</a></li>
                <li><a href="#">{{__('Blog')}}</a></li>
            </ul>    
        </div>
        <div class="catalog-mob--content_footer">
            <ul class="catalog-mob--footer_list">
                <li class="catalog-mob--footer_list-item">
                    <a href="#">
                        +1 900 777525
                    </a>
                </li>
                <li class="catalog-mob--footer_list-item">
                    <a href="#">
                        info@tasty-daily.com
                    </a>
                </li>
                <li class="catalog-mob--footer_list-item">
                    <a href="#">
                        Vokzalnaya street, 34, Pervomaysk, Nikolaev region, Ukraine© Growex
                    </a>
                </li>
                <li class="catalog-mob--footer_list-item">
                    <a href="#">
                        from 8:30 to 18:00
                    </a>
                </li>
                    
            </ul>
        </div>

    </div>
      
</div>