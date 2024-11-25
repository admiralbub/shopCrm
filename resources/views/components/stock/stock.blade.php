<div class="stocks_block">
    <a href="{{route('stock.show',['slug'=>$stock->slug])}}">
        <img src="{{asset($stock->img)}}">
    </a>
    <div class="stocks_date">
        @php 
            $date_start = new DateTime($stock->start_stocks_date);
            $end_start = new DateTime($stock->end_stocks_date);
        @endphp
        <span>
            <i class="bi bi-calendar"></i>
            {{\Carbon\Carbon::parse($date_start)->locale($lang)->isoFormat('D MMMM')}} —   {{\Carbon\Carbon::parse($end_start)->locale($lang)->isoFormat('D MMMM ')}}
        </span>
    </div>
    <div class="stocks_text"> 
        <a href="/stock/{{$stock->slug}}">
            {{$stock->name}}
        </a>
    </div>
    <div class="date_last-stock">
        <span>
            @if(\Carbon\Carbon::parse($end_start)->locale($lang)->diffInDays() != 0)    
                {{__("left_time")}} {{\Carbon\Carbon::parse($end_start->format('Y-m-d'))->locale($lang)->diffInDays()}} {{__("days_stock")}}
            @else
                {{\Carbon\Carbon::parse($end_start)->locale($lang)->diffInHours()}}  {{__("hourse_title")}}
            @endif
        </span>
    </div>
 </div>