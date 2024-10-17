<?php

namespace App\Orchid\Screens\Attr;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use App\Models\Attr;
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


class AttrEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $attr;
    public function query(Attr $attr): array
    {
        return [
            'attr' => $attr
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->attr->exists ? __("Edit attribute") : __("Add attribute");
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make( __("Add attribute"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->attr->exists),

            Button::make( __("Edit attribute"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->attr->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->attr->exists),
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
                Input::make('attr.name_ru')
                    ->required()
                    ->title(__('Heading',['locale'=>'(ru)'])),
                Input::make('attr.name_ua')
                    ->required()
                    ->title(__('Heading',['locale'=>'(ua)'])),

                Select::make('attr.group_id')
                    ->required()
                    ->fromModel(AttrGroup::where('status','=',1), 'name_ua')
                    ->title(__('Attribute group')), 
                CheckBox::make('attr.status')
                    ->sendTrueOrFalse()
                    ->title(__('Publish'))
            ])
        ];
    }
    public function createOrUpdate(Request $request)
    {
        $this->attr->fill($request->get('attr'))->save();

        $title_operation = $this->attr->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.attr.edit',$this->attr->id);
    }
    public function remove()
    {

        $this->attr->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.attr.list');
    }
}
