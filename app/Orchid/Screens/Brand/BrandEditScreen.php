<?php

namespace App\Orchid\Screens\Brand;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;


use App\Models\Brand;
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

class BrandEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $brand;
    public function query(Brand $brand): array
    {
        return [
            'brand' => $brand
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->brand->exists ? __("Edit brand") : __("Create brand");
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make( __("Create brand"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->brand->exists),

            Button::make( __("Edit brand"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->brand->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->brand->exists),
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
                        Input::make('brand.name_ru')
                            ->required()
                            ->title(__('Heading',['locale'=>'(ru)'])),
                        Input::make('brand.name_ua')
                            ->required()
                            ->title(__('Heading',['locale'=>'(ua)'])),
                        Picture::make('brand.images')
                             ->title(__('Image'))
                             ->required()
                             ->storage('images_brand'),
                        CKEditor::make('brand.description_ru')
                            ->title(__('Description',['locale'=>'(ru)']))
                            ->rows(5),
                        CKEditor::make('brand.description_ua')
                             ->title(__('Description',['locale'=>'(ua)']))
                             ->rows(5),

                        CheckBox::make('brand.status')
                             ->sendTrueOrFalse()
                             ->title(__('Publish'))
                             
                    
                    ]),
                ],
                 'SEO' => [
                    Layout::rows([
                        Input::make('brand.h1_ru')
                            ->title('H1 (ru)'),
                        Input::make('brand.h1_ua')
                            ->title('H1 (ua)'),

                        Input::make('brand.meta_title_ru')
                            ->title('Title (ru)'),
                        Input::make('brand.meta_title_ua')
                            ->title('Title (ua)'),
                        TextArea::make('brand.meta_description_ru')
                            ->title('Meta description (ru)')
                            ->rows(5),
                        TextArea::make('brand.meta_description_ua')
                            ->title('Meta description (ua)')
                            ->rows(5),

                         TextArea::make('brand.meta_keywords_ru')
                            ->title('Keywords (ru)')
                            ->rows(5),
                        TextArea::make('brand.meta_keywords_ua')
                            ->title('Keywords (ua)')
                            ->rows(5),
                    ]),
                ],

            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $this->brand->fill($request->get('brand'))->save();

        $title_operation = $this->brand->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.brand.edit',$this->brand->id);
    }
    public function remove()
    {

        $this->brand->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.brands.list');
    }
}
