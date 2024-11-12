<?php

namespace App\Orchid\Screens\MainSlider;


use App\Models\MainSlider;
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
class MainSliderEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $mainslider;

    public function query(MainSlider $mainslider): array
    {
        return [
            'mainslider' => $mainslider
        ];
    }
    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->mainslider->exists ? __('Edit slider') : __('Add slider');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make( __("Add"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->mainslider->exists),

            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->mainslider->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->mainslider->exists),
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
            Layout::rows([
                Picture::make('mainslider.img')
                    ->storage('main_banner')
                    ->maxFileSize(1)
                    ->title(__('Image'))
                    ->required(),
                Input::make('mainslider.url')
                    ->title(__("Link")),
                CheckBox::make('mainslider.permanent_status')
                    ->sendTrueOrFalse()
                    ->help(__('This checkbox allows the banner to be active on the site regardless of the selected display date.'))
                    ->title(__("Permanent banner")),

        
                CheckBox::make('mainslider.status')
                    ->sendTrueOrFalse()
                    ->title(__("Status")),

               
                DateTimer::make('mainslider.start_banner_date')
                    ->required()
                    ->title(__("Start date of the banner display")),
                DateTimer::make('mainslider.end_banner_date')
                    ->required()
                    ->title(__("End date of the banner display")),
            
            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $this->mainslider->fill($request->get('mainslider'))->save();

        $title_operation = $this->mainslider->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.mainslider.edit',$this->mainslider->id);
    }
    public function remove()
    {

        $this->mainslider->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.mainslider.list');
    }
}
