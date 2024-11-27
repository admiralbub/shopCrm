<?php

namespace App\Orchid\Layouts\OrderProduct;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\OrderProduct;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Components\Cells\DateTimeSplit;
class OrderProductListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'order_product';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->width(20),
            TD::make(__('Name'))->width(220)->render(function (OrderProduct $order_product) {
                return '<a href="/product/'.$order_product->product->slug.'">'.$order_product->product->name.'</a>';
                
            }),
            TD::make(__('Pack'))->width(70)->render(function (OrderProduct $order_product) {
                return $order_product->product->packs()->first()->name;
                
                
            }),
            TD::make(__('Price'))->width(70)->render(function (OrderProduct $order_product) {
                return $order_product->price;
                
            }),
            TD::make(__('Quantity'))->width(70)->render(function (OrderProduct $order_product) {
                return $order_product->quantity;
                
            }),
        ];
    }
}
