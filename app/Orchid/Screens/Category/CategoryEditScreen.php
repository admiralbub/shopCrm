<?php

namespace App\Orchid\Screens\Category;

use Orchid\Screen\Screen;
use App\Models\Category;
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


use Nakipelo\Orchid\CKEditor\CKEditor;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Actions\Menu;
class CategoryEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $category;
    public function query(Category $category): array
    {
        return [
            'category' => $category
        ];
    }

    public function name(): ?string
    {
        return $this->category->exists ? __("Edit category") : __("Add category");
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make( __("Add category"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->category->exists),

            Button::make( __("Edit category"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->category->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->category->exists),
            Menu::make(__('Show'))
                ->icon('bs.eye-fill')
                ->canSee($this->category->exists)
                ->url('/products/'.$this->category->slug), 
            
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
                        Input::make('category.name_ru')
                            ->required()
                            ->title(__('Heading',['locale'=>'(ru)'])),
                        Input::make('category.name_ua')
                            ->required()
                            ->title(__('Heading',['locale'=>'(ua)'])),
                        

                        Picture::make('category.icon')
                            ->title(__('Icon'))
                            ->storage('images_category'),
                        Select::make('category.category_id')
                            ->fromModel(Category::class, 'name_ua')
                            ->title(__('Parent'))
                            ->help(__('If your category is the main one, then for details, select the item No subcategory'))
                            ->empty(_('No select')),

                        CKEditor::make('category.description_ru')
                            ->title(__('Description',['locale'=>'(ru)']))
                            ->rows(5),
                        CKEditor::make('category.description_ua')
                             ->title(__('Description',['locale'=>'(ua)']))
                             ->rows(5),

                        CheckBox::make('category.is_top')
                            ->sendTrueOrFalse()
                            ->title(__('Top category')),
                        CheckBox::make('category.status')
                            ->sendTrueOrFalse()
                            ->title(__('Publish'))

                    ])
                ],
                'SEO' => [
                    Layout::rows([
                        Input::make('category.h1_ru')
                            ->required()
                            ->title('H1 (ru)'),
                        Input::make('category.h1_ua')
                            ->required()
                            ->title('H1 (ua)'),

                        Input::make('category.meta_title_ru')
                            ->required()
                            ->title('Title (ru)'),
                        Input::make('category.meta_title_ua')
                            ->required()
                            ->title('Title (ua)'),
                        TextArea::make('category.meta_description_ru')
                            ->required()
                            ->title('Meta description (ru)')
                            ->rows(5),
                        TextArea::make('category.meta_description_ua')
                            ->required()
                            ->title('Meta description (ua)')
                            ->rows(5),

                         TextArea::make('category.meta_keywords_ru')
                            ->title('Keywords (ru)')
                            ->rows(5),
                        TextArea::make('category.meta_keywords_ua')
                            ->title('Keywords (ua)')
                            ->rows(5),
                    ]),
                ],
            ])
        ];
    }
    public function createOrUpdate(Request $request)
    {
        $this->category->fill($request->get('category'))->save();

        $title_operation = $this->category->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.category.edit',$this->category->id);
    }
    public function remove()
    {

        $this->category->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.catogories.list');
    }
   
   
}
