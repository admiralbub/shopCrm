@props(['title','descriptions','keywords'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$title ?? ""}}</title>
        <meta name="description" content="{{$descriptions ?? ''}}">
        <meta name="keywords" content="{{$keywords ?? ''}}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite('resources/js/app.js')
        @vite('resources/scss/app.scss')
    </head>
    
    <body>
    <div class="main h-100">
        <div class="container">
            <div class="row no-gutters align-items-stretch">
                <div class="col-lg-5 min-vh-100 d-flex align-items-center">
                    <div class=" w-100 vw-md-50 w-lg-100 my-11 mx-auto">
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <a href="{{route('index')}}">
                                <img src="{{settings('logo_site')}}" width="150px">
                            </a>
                            <a href="#" data-bs-toggle="dropdown" aria-expanded="false" class="langue">
                           
                                <span class="text-uppercase">{{ LaravelLocalization::getCurrentLocale()}}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M19.9201 8.94995L13.4001 15.47C12.6301 16.24 11.3701 16.24 10.6001 15.47L4.08008 8.94995" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
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
                        </div>
                        
                        {{ $slot }}
                    </div>
                </div>
                <div class="d-none d-lg-block col-lg-6 offset-lg-1">
                    <div class="bg-overlay" style="background-image: url({{asset('images/login-page-bg-C5mjR5sO-v4.5.5.png')}});"></div>
                </div>
            </div>
        </div>
        
    </body>
</html>