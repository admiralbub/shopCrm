<x-layouts.app  
    :title="$stock->meta_title_parsed"
    :descriptions="$stock->descriptione_parsed"
    :keywords="$stock->keywordse_parsed">

    <div class="container mb-5">
        <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>


      

        <div class="stocks_page">
            <div class="stocks_info">
                <div class="stocks_info_image">
                    <img src="{{asset($stock->img)}}">
                </div>
                <div class="stocks_info_text">
                    <span class="stocks_info_date">
                       {{dateBetween($stock->start_stocks_date, $stock->end_stocks_date, $lang)}}

                    
                    </span>
                    <h1 class="stocks_info_heading fs-4" >
                        {{$stock->h1_parsed}}
                    </h1>
                   
                    <div class="stocks_timer_date">
                        <span>
                            @if(lastDay($stock->start_stocks_date, $stock->end_stocks_date) > 0)
                                {{ __("left_time") }} {{ lastDay($stock->start_stocks_date, $stock->end_stocks_date) }} {{ __("days_stock") }}
                            @elseif(lastDay($stock->start_stocks_date, $stock->end_stocks_date) === 0)
                                {{ __("left_time") }} {{ lastDay($stock->start_stocks_date, $stock->end_stocks_date)->diffInHours($end_date, false) }} {{ __("hours_title") }}
                            @else
                                {{ __("expired_title") }} <!-- Например, "Акция завершена" -->
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