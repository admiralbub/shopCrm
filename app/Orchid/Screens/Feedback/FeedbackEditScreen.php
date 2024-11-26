<?php

namespace App\Orchid\Screens\Feedback;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\Picture;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Menu;
use App\Orchid\Fields\RateInput;
class FeedbackEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $feedback;
    public function query(Feedback $feedback): array
    {
        return [
            'feedback' => $feedback
        ];
    }

   
    public function name(): ?string
    {
        return __('Edit feedback',["number"=>$this->feedback->id]);
    }


    public function commandBar(): iterable
    {
        return [
            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate'),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.')),
        
            Menu::make(__('Show'))
                ->icon('bs.eye-fill')
                ->canSee($this->feedback->exists)
                ->url('/product/'.$this->feedback->product->slug),     
        ];
    }

  
    public function layout(): iterable
    {
        return [
            Layout::rows([
                
                Input::make('feedback.user_name')
                    ->required()
                    ->title('firstName_title'),
                Input::make('feedback.email')
                    ->required()
                    ->title('Email'),
                TextArea::make('feedback.comment')
                    ->required()
                    ->title(__('Feedback')),


                RateInput::make('feedback.rating')
                    ->title(__('Grade'))
                    ->haveRated($this->feedback->rating),    
                TextArea::make('feedback.response')
                    ->title(__('Response')),

                CheckBox::make('feedback.status')
                    ->sendTrueOrFalse()
                    ->title(__("Publish")),
            ])
        ];
    }
    public function createOrUpdate(Request $request)
    {
        $this->feedback->fill($request->get('feedback'))->save();

        $title_operation = $this->feedback->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.feedback.edit',$this->feedback->id);
    }
    public function remove()
    {

        $this->feedback->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.feedback.list');
    }
}
