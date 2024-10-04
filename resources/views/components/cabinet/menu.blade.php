<ul class="account-menu">
    @foreach($menu as $menuCabinetItem)
        <li>
            <a href="{{ route($menuCabinetItem['route']) }}" 
                class="{{(Route::currentRouteName() == $menuCabinetItem['route']) ? 'active' : ''}}"> 
                <i class="{{$menuCabinetItem['icon']}}"></i>
                <span>
                    {{ __($menuCabinetItem['title']) }}
                </span>   
            </a>
        </li>
    @endforeach
</ul>