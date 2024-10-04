<?php

namespace App\Orchid\Screens\Product;

use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use App\Models\Product;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Product\ProductFiltersLayout;
use App\Orchid\Layouts\Product\ProductListLayout;
class ProductListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'product' => Product::filters(ProductFiltersLayout::class)->orderBy('id','DESC')->defaultSort('id')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Goods');
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
                ->route('platform.product.create')
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
            ProductFiltersLayout::class,
            ProductListLayout::class
        ];
    }
    public function remove_product(Request $request): void
    {
        Product::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
