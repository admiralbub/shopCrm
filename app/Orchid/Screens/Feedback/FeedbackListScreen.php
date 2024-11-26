<?php

namespace App\Orchid\Screens\Feedback;

use Orchid\Screen\Screen;
use App\Models\Feedback;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Feedback\FeedbackListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;


class FeedbackListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'feedback' => Feedback::filters()->orderBy('id','DESC')->defaultSort('id')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Feedbacks');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            FeedbackListLayout::class
        ];
    }
    public function remove_feedback(Request $request): void
    {
        Feedback::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
