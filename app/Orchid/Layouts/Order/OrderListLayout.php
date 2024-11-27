<?php

namespace App\Orchid\Layouts\Order;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Order;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Components\Cells\DateTimeSplit;

class OrderListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'order';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->sort()->width(70),
            
            TD::make('first_name', __("firstName_title"))->width(120),
            TD::make('last_name', __("lastName_title"))->width(120),
            TD::make('middle_name', __("MiddleName_title"))->width(120),
           
            TD::make('phone', __("Phone_title"))->width(120),
            TD::make('', __('Deliver'))->sort()->width(120)
                ->render(function (Order $order) {
                    if($order->deliver_type) {
                        return $order->deliver_name;
                    } else {
                        return '';
                    }
            
                }), 
            TD::make('', '')->sort()->width(220)
                ->render(function (Order $order) {
                    if($order->deliver_type) {
                        if($order->deliver_type=="NP") {
                            return $order->np_city.' '.$order->np_warehouse;
                        }
                    }
                
                }), 
            TD::make('total', __("total"))->width(120),
            TD::make('status', __('Status'))->sort()->width(120)
                ->render(function (Order $order) {
                    return $order->status_text;
                
                }), 

            
            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->width(120)
                ->align(TD::ALIGN_RIGHT),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Order $order) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.order.edit', $order->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove_order', [
                                'id' => $order->id,
                            ]),
                    ])),
        ];
    }
}
