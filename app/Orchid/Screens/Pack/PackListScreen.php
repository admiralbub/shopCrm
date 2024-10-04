<?php

namespace App\Orchid\Screens\Pack;

use Orchid\Screen\Screen;
use App\Models\Pack;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Pack\PackListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;
use App\Orchid\Layouts\Pack\PackFiltersLayout;
class PackListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'pack' => Pack::filters(PackFiltersLayout::class)->orderBy('id','DESC')->defaultSort('id')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Pack');
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
                ->route('platform.pack.create')
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
            PackFiltersLayout::class,
            PackListLayout::class
        ];
    }
    public function remove_pack(Request $request): void
    {
        Pack::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
