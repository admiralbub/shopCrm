<?php

namespace App\Orchid\Layouts\Stock;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Stock;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Components\Cells\DateTimeSplit;

class StockListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'stock';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->sort()->width(70),
            TD::make('img', __('Image'))->width(50)
                ->render(function (Stock $stock) {
                    return '<img src="'.$stock->img.'" width="65px;">';
                }),   
            TD::make('name', __('Name')),
            TD::make('start_stocks_date', __('Promotion start date'))->width(420),
            TD::make('end_stocks_date',  __('Promotion end date'))->width(420),
            TD::make('status', __('Status'))->sort()
                ->render(function (Stock $stock) {
                    if ($stock->status==1) {
                        return "<span class=\"badge bg-success  text-white\" >".__('Active')."</span>";
                    } else {
                        return "<span class=\"badge bg-danger text-white\">".__('No active')."</span>";
                    }
                
                }),  
            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->width(120)
                ->align(TD::ALIGN_RIGHT),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Stock $stock) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.stock.edit', $stock->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove_stock', [
                                'id' => $stock->id,
                            ]),
                    ])),
        ];
    }
}
