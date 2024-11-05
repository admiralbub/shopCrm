<?php

namespace App\Orchid\Screens\Brand;

use Orchid\Screen\Screen;
use App\Models\Brand;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Brand\BrandListLayout;
use App\Orchid\Layouts\Brand\BrandFiltersLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;
class BrandScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'brand' => Brand::filters(BrandFiltersLayout::class)->orderBy('id','DESC')->defaultSort('id')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Brand';
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
                ->route('platform.brand.create')
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
            BrandFiltersLayout::class,
            BrandListLayout::class
        ];
    }
    public function remove_brand(Request $request): void
    {
        Brand::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
