<x-layouts.app  
    :title="$stock->meta_title_parsed"
    :descriptions="$stock->descriptione_parsed"
    :keywords="$stock->keywordse_parsed">

    <div class="container mb-5">
        <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>


        @php 
            $date_start = new DateTime($stock->start_stocks_date);
            $end_start = new DateTime($stock->end_stocks_date);
        @endphp

        <div class="stocks_page">
            <div class="stocks_info">
                <div class="stocks_info_image">
                    <img src="{{asset($stock->img)}}">
                </div>
                <div class="stocks_info_text">
                    <span class="stocks_info_date">
                        {{\Carbon\Carbon::parse($date_start)->locale($lang)->isoFormat('D MMMM')}} —   {{\Carbon\Carbon::parse($end_start)->locale($lang)->isoFormat('D MMMM ')}}
                    </span>
                    <h1 class="stocks_info_heading fs-4" >
                        {{$stock->h1_parsed}}
                    </h1>
                   
                    <div class="stocks_timer_date">
                        <span>
                            @if(\Carbon\Carbon::parse($end_start)->locale($lang)->diffInDays() != 0)    
                                {{__("left_time")}} {{\Carbon\Carbon::parse($end_start)->locale($lang)->diffInDays()}} {{__("days_stock")}}
                            @else
                                {{\Carbon\Carbon::parse($end_start)->locale($lang)->diffInHours()}}  {{__("hourse_title")}}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <div class="stocks_about">
                {!! $stock->body !!}

            </div>
        </div>
        <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-sm-2 row-cols-2 mb-30 card_products">
            @foreach($products as $product)
                <x-products.product :product="$product"></x-products.product>
            @endforeach
        </div>
        {!! $products->links() !!}

    </div>
</x-layouts.app>