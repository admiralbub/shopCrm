<?php

namespace App\Orchid\Screens\Stock;

use App\Models\Stock;
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
use Orchid\Screen\Fields\DateTimer;
use Nakipelo\Orchid\CKEditor\CKEditor;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\CheckBox;

class StockEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $stock;
    public function query(Stock $stock): array
    {
        return [
            'stock' => $stock
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->stock->exists ? __("Edit stock") : __("Add stock");
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
            ->canSee(!$this->stock->exists),

        Button::make( __("Edit"))
            ->icon('bs.pencil')
            ->method('createOrUpdate')
            ->canSee($this->stock->exists),

        Button::make(__('Remove'))
            ->icon('trash')
            ->method('remove')
            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
            ->canSee($this->stock->exists),
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
            Layout::tabs([
                __('Basic information') => [
                    Layout::rows([
                        Input::make('stock.name_ru')
                            ->required()
                            ->title(__('Heading',['locale'=>'(ru)'])),
                        Input::make('stock.name_ua')
                            ->required()
                            ->title(__('Heading',['locale'=>'(ua)'])),

                        Picture::make('stock.img')
                            ->required()
                            ->title(__('Image'))
                            ->storage('images_page'),
                        CKEditor::make('stock.body_ru')
                            ->title(__('Description',['locale'=>'(ru)']))
                            ->rows(5),
                        CKEditor::make('stock.body_ua')
                            ->title(__('Description',['locale'=>'(ua)']))
                            ->rows(5),


                        DateTimer::make('stock.start_stocks_date')
                            ->required()
                            ->allowInput()
                            ->title(__('Promotion start date')),
                        DateTimer::make('stock.end_stocks_date')
                            ->required()
                            ->allowInput()
                            ->title(__('Promotion end date')),

                        CheckBox::make('stock.status')
                            ->sendTrueOrFalse()
                            ->title(__('Publish')),    
            
                    ]),
                ],
                 'SEO' => [
                    Layout::rows([
                        Input::make('stock.h1_ru')
                            ->title('H1 (ru)'),
                        Input::make('stock.h1_ua')
                            ->title('H1 (ua)'),

                        Input::make('stock.meta_title_ru')
                            ->title('Title (ru)'),
                        Input::make('stock.meta_title_ua')
                            ->title('Title (ua)'),
                        TextArea::make('stock.meta_description_ru')
                            ->title('Meta description (ru)')
                            ->rows(5),
                        TextArea::make('stock.meta_description_ua')
                            ->title('Meta description (ua)')
                            ->rows(5),

                         TextArea::make('stock.meta_keywords_ru')
                            ->title('Keywords (ru)')
                            ->rows(5),
                        TextArea::make('stock.meta_keywords_ua')
                            ->title('Keywords (ua)')
                            ->rows(5),
                    ]),
                ],

            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $this->stock->fill($request->get('stock'))->save();

        $title_operation = $this->stock->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.stock.edit',$this->stock->id);
    }
    public function remove()
    {

        $this->stock->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.stock.list');
    }
}
