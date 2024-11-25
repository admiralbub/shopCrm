<?php

namespace App\Orchid\Screens\Stock;

use Orchid\Screen\Screen;
use App\Models\Stock;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Stock\StockListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class StockListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'stock' => stock::filters()->orderBy('id','DESC')->defaultSort('id')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Stocks');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.pencil')
                ->route('platform.stock.create')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            StockListLayout::class
        ];
    }
    public function remove_stock(Request $request): void
    {
        Stock::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
