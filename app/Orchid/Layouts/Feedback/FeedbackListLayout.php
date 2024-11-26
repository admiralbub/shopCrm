<?php

namespace App\Orchid\Layouts\Feedback;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Feedback;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use App\Orchid\Fields\Rate;
class FeedbackListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'feedback';


    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->sort(),
            TD::make('user_name', __("firstName_title")),
            TD::make('email', __("Email")),
            TD::make('status', __('Grade'))->sort()
                ->render(function (Feedback $feedback) {
                    return Rate::make('rating')
                    ->count(5)
                    ->readonly(true)
                    ->haveRated($feedback->rating);
                    
                }),
            TD::make('status', __('Status'))
                ->render(function (Feedback $feedback) {
                    if ($feedback->status==1) {
                        return "<span class=\"badge bg-success  text-white\" >".__('Active')."</span>";
                    } else {
                        return "<span class=\"badge bg-danger text-white\">".__('No active')."</span>";
                    }
                    
                }),    
            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->width(120)
                ->align(TD::ALIGN_RIGHT),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Feedback $feedback) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.feedback.edit', $feedback->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove_feedback', [
                                'id' => $feedback->id,
                            ]),
                    ])),
        ];
    }
}
