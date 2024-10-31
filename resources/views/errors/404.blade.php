<x-layouts.app  
    :title="__('not_found_title')"
    :descriptions="__('not_found_title')"
    :keywords="__('not_found_title')">

    <div class="container mt-5 mb-4 not-page">
	    <h1>{{__("not_found_title")}}</h1>
        <br>
        @foreach(__('not_found_text') as $text)
            {!! $text !!}
        @endforeach
       
    </div>

</x-layouts.app>