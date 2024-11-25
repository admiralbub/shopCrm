<x-layouts.app  
    :title="__('Stocks')"
    :descriptions="__('Stocks')"
    :keywords="__('Stocks')">

    <div class="container mb-5">
        <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>
        <h1 class="fs-2">{{__('Stocks')}}</h1>
        <div class="stocks">
            <div class="stocks_item">
                @if(count($stocks)>0)
                    @foreach($stocks as $stock)
                        <x-stock.stock :stock="$stock" :lang="$lang"></x-stock.stock>
                    @endforeach
                    {!! $stocks->links() !!}
                @else
                    <p>{{__('stock_title_noempty')}}</p>
                 @endif
            </div>
        </div> 
    </div>
</x-layouts.app>