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

       
        @vite('resources/scss/app.scss')
        @vite('resources/js/app.js')
    </head>
    
    <body>
        <x-alert.toast/>
        <x-layouts.header/>
        <x-layouts.header-mob/>
        <x-layouts.catalog/>
        <div class="main mt-2 mt-md-1">
            {{ $slot }}
        </div>
        <x-block.subscribers/>
        <x-layouts.footer/>
        <x-layouts.mob_nav_bottom/>
        <x-basket/>
        <div class="body-overlay"></div>
    </body>
</html>