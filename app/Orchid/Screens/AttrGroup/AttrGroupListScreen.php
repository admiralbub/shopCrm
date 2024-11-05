<?php

namespace App\Orchid\Screens\AttrGroup;

use Orchid\Screen\Screen;
use App\Models\AttrGroup;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\AttrGroup\AttrGroupListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class AttrGroupListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'attrgroup' => AttrGroup::filters()->orderBy('id','DESC')->defaultSort('id')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Attribute group');
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
                ->route('platform.attrgroup.create')
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
            AttrGroupListLayout::class,
        ];
    }
    public function remove_attrgroup(Request $request): void
    {
        AttrGroup::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
