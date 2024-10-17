<?php

namespace App\Orchid\Screens\AttrGroup;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use App\Models\AttrGroup;
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

class AttrGroupEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $attrgroup;
    public function query(AttrGroup $attrgroup): array
    {
        return [
            'attrgroup' => $attrgroup
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->attrgroup->exists ? __("Edit attribute group") : __("Add attribute group");
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make( __("Add attribute group"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->attrgroup->exists),

            Button::make( __("Edit attribute group"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->attrgroup->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->attrgroup->exists),
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
                Input::make('attrgroup.name_ru')
                    ->required()
                    ->title(__('Heading',['locale'=>'(ru)'])),
                Input::make('attrgroup.name_ua')
                    ->required()
                    ->title(__('Heading',['locale'=>'(ua)'])),
                CheckBox::make('attrgroup.status')
                    ->sendTrueOrFalse()
                    ->title(__('Publish'))
            ])
        ];
    }
    public function createOrUpdate(Request $request)
    {
        $this->attrgroup->fill($request->get('attrgroup'))->save();

        $title_operation = $this->attrgroup->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.attrgroup.edit',$this->attrgroup->id);
    }
    public function remove()
    {

        $this->attrgroup->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.attrgroup.list');
    }
}
