<?php

namespace App\Orchid\Screens\MainSlider;

use Orchid\Screen\Screen;
use App\Models\MainSlider;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\MainSlider\MainSliderListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class MainSliderListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'mainslider' => MainSlider::filters()->orderBy('id','DESC')->defaultSort('id')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Sliders');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
           // Button::make('Активувати потстійні слайдер')
                //->method('bulkActions'),
            Link::make(__("Add"))
                ->icon('pencil')
                ->route('platform.mainslider.create'),
            
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
            MainSliderListLayout::class
        ];
    }
    public function remove_mainslide(Request $request): void
    {
        MainSlider::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
