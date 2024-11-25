<div class="stocks_block">
    <a href="{{route('stock.show',['slug'=>$stock->slug])}}">
        <img src="{{asset($stock->img)}}">
    </a>
    <div class="stocks_date">
        
        <span>
            <i class="bi bi-calendar"></i>
            {{dateBetween($stock->start_stocks_date, $stock->end_stocks_date, $lang)}}
        </span>
    </div>
    <div class="stocks_text"> 
        <a href="/stock/{{$stock->slug}}">
            {{$stock->name}}
        </a>
    </div>
    <div class="date_last-stock">
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