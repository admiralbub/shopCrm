<?php

namespace App\Orchid\Screens\Price;

use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use App\Models\Price;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Price\PriceListLayout;
use App\Orchid\Layouts\Price\PriceFiltersLayout;
class PriceListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'price' => Price::filters(PriceFiltersLayout::class)->orderBy('id','DESC')->defaultSort('id')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Price variation');
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
                ->route('platform.price.create')
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
            PriceFiltersLayout::class,
            PriceListLayout::class
        ];
    }
    public function remove_price(Request $request): void
    {
        Price::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
