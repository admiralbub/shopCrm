<?php

namespace App\Orchid\Screens\Category;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Link;
use App\Models\Category;
class CategoryListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __("Catogories");
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add category'))
                ->icon('bs.pencil')
                ->route('platform.categories.create')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {   
        $categories = Category::whereNull('category_id')->orderBy('sort')->with('childrenCategories')->get();
        return [
            Layout::view('admin.category',[
                'categories'=>$categories
            ]),
        ];
    }
}
