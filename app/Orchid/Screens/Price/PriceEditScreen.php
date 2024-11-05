<?php

namespace App\Orchid\Screens\Price;

use App\Models\Price;
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

class PriceEditScreen extends Screen
{
   
    public $price;
    public function query(Price $price): array
    {
        return [
            'price' => $price
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->price->exists ? __("Edit price") : __("Add price");
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make( __("Add price"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->price->exists),

            Button::make( __("Edit price"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->price->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->price->exists),
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
                Input::make('price.name_ru')
                    ->required()
                    ->title(__('Heading',['locale'=>'(ru)'])),
                Input::make('price.name_ua')
                    ->required()
                    ->title(__('Heading',['locale'=>'(ua)'])),
                Input::make('price.price')
                    ->required()
                    ->title(__('Price')),

                CheckBox::make('price.status')
                     ->sendTrueOrFalse()
                     ->title(__('Publish'))
                     
            
            ]),
        ];
    }
    public function createOrUpdate(Request $request)
    {
        $this->price->fill($request->get('price'))->save();

        $title_operation = $this->price->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.price.edit',$this->price->id);
    }
    public function remove()
    {

        $this->price->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.prices.list');
    }
}
