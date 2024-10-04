<?php

namespace App\Orchid\Screens\Pack;

use App\Models\Pack;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Picture;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

use Nakipelo\Orchid\CKEditor\CKEditor;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\CheckBox;

class PackEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $pack;
    public function query(Pack $pack): array
    {
        return [
            'pack' => $pack
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->pack->exists ? __("Edit pack") : __("Add pack");
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make( __("Add pack"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->pack->exists),

            Button::make( __("Edit pack"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->pack->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->pack->exists),
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
                Input::make('pack.name_ru')
                    ->required()
                    ->title(__('Heading',['locale'=>'(ru)'])),
                Input::make('pack.name_ua')
                    ->required()
                    ->title(__('Heading',['locale'=>'(ua)'])),
                Input::make('pack.volume')
                    ->required()
                    ->title(__('Volume/value')),

                CheckBox::make('pack.status')
                     ->sendTrueOrFalse()
                     ->title(__('Publish'))
                     
            
            ]),
        ];
    }
    public function createOrUpdate(Request $request)
    {
        $this->pack->fill($request->get('pack'))->save();

        $title_operation = $this->pack->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.pack.edit',$this->pack->id);
    }
    public function remove()
    {

        $this->pack->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.packs.list');
    }
}
