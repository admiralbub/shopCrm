
<div class="top-nav">
    <div class="container">
        <div class="d-flex  justify-content-between">
            <div class="top-nav-left">
                {{settings('text_left_site_'.app()->getLocale())}}
            </div>
            
            <div class="top-nav-right">
                
                <ul class="top-nav-right-list d-lg-flex d-none">
                    @auth
              
                        @if(!empty(auth()->user()->permissions))
                            <li>
                                <a href="/admin" target="_blank" >{{__('Admin panel')}}</a>
                            </li>
                        @endif
                    @endif
                    <li class="dropdown">
                         <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                           
                            <span class="text-uppercase">{{ LaravelLocalization::getCurrentLocale()}}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                                  
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                               
                                <a href="{{ LaravelLocalization::getLocalizedURL('ua', null, [], true) }}"
                                    class="dropdown-item">
                                    <span>Українська</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ LaravelLocalization::getLocalizedURL('ru', null, [], true) }}"
                                    class="dropdown-item">
                                    <span>Русский</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li >
                        @guest
                            <a href="{{route('auth.enter')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                <span>
                                    {{__('Enter')}}
                                </span>
                                
                            </a>
                        @else   
                            <a href="#"  data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                <span>
                                    {{__('Profil')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{route('profile')}}">
                                        
                                        <span>{{__('Account')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{route('auth.signout')}}">
                                        
                                        <span>{{__('Sign out')}}</span>
                                    </a>
                                </li>
                            </ul>
                        @endauth 
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
 <header class="header mt-lg-0 mt-2 d-lg-flex d-none">
    <div class="container">
        <div class="row align-items-center">
            <div class="header-logo col col-lg-3">
                <a href="{{route('index')}}">
                    <img src="{{settings('logo_site')}}" width="150px">
                </a>
                    
            </div>
            <div class="col col-lg-5 d-lg-block d-none">
                <ul class="header-menu pt-2">
                    <li class="header-menu-item"><a href="{{route('index')}}">{{__('Home')}}</a></li>
                    <li class="header-menu-item"><a href="#">{{__('Stocks')}}</a></li>
                    <li class="header-menu-item"><a href="{{route('product.brand.list')}}">{{__('Brand')}}</a></li>
                    <li class="header-menu-item"><a href="#">{{__('Blog')}}</a></li>
                </ul>
            </div>
            <div class="col col-lg-4 mt-lg-3 mt-0">
                <div class="header-menu-phone d-flex justify-content-end">
                    <div class="header-menu-phone-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </div>
                        
                    <span class="header-menu-phone-content pl-2">
                        <small>{{__('Phone_title')}}:</small>
                        <p>
                            <a href="tel:{{ str_replace([' ', '(', ')', '-'], '', settings('phone_site'))}}">{{settings('phone_site')}}</a>
                        </p>
                    </span>
                </div>
                    
            </div>
        </div>
    </div>
        
</header>
