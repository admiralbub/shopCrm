<?php

namespace App\Orchid\Screens\Attr;

use Orchid\Screen\Screen;
use App\Models\Attr;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Attr\AttrListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class AttrListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'attr' => Attr::filters()->orderBy('id','DESC')->defaultSort('id')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Attribute');
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
                ->route('platform.attr.create')
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
            AttrListLayout::class
        ];
    }
    public function remove_attr(Request $request): void
    {
        Attr::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
