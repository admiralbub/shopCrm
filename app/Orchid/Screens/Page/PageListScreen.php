<?php

namespace App\Orchid\Screens\Page;

use Orchid\Screen\Screen;
use App\Models\Page;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Page\PageListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class PageListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'page' => Page::filters()->orderBy('id','DESC')->defaultSort('id')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __("Pages");
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
                ->route('platform.page.create')
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
            PageListLayout::class
        ];
    }
    public function remove_page(Request $request): void
    {
        Page::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
