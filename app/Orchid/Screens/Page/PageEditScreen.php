<?php

namespace App\Orchid\Screens\Page;

use App\Models\Page;
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

class PageEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $page;
    public function query(Page $page): array
    {
        return [
            'page' => $page
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->page->exists ? __("Edit page") : __("Add page");
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
                ->canSee(!$this->page->exists),

            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->page->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->page->exists),
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
                        Input::make('page.name_ru')
                            ->required()
                            ->title(__('Heading',['locale'=>'(ru)'])),
                        Input::make('page.name_ua')
                            ->required()
                            ->title(__('Heading',['locale'=>'(ua)'])),

                        Input::make('page.url')
                            ->required()
                            ->title(__('Url')),
                        Picture::make('page.img')
                             ->title(__('Image'))
                             ->storage('images_page'),
                        CKEditor::make('page.description_ru')
                            ->title(__('Description',['locale'=>'(ru)']))
                            ->rows(5),
                        CKEditor::make('page.description_ua')
                             ->title(__('Description',['locale'=>'(ua)']))
                             ->rows(5),

                        CheckBox::make('page.status')
                             ->sendTrueOrFalse()
                             ->title(__('Publish'))
                             
                    
                    ]),
                ],
                 'SEO' => [
                    Layout::rows([
                        Input::make('page.h1_ru')
                            ->required()
                            ->title('H1 (ru)'),
                        Input::make('page.h1_ua')
                            ->required()
                            ->title('H1 (ua)'),

                        Input::make('page.meta_title_ru')
                            ->required()
                            ->title('Title (ru)'),
                        Input::make('page.meta_title_ua')
                            ->required()
                            ->title('Title (ua)'),
                        TextArea::make('page.meta_description_ru')
                            ->required()
                            ->title('Meta description (ru)')
                            ->rows(5),
                        TextArea::make('page.meta_description_ua')
                            ->required()
                            ->title('Meta description (ua)')
                            ->rows(5),

                         TextArea::make('page.meta_keywords_ru')
                            ->title('Keywords (ru)')
                            ->rows(5),
                        TextArea::make('page.meta_keywords_ua')
                            ->title('Keywords (ua)')
                            ->rows(5),
                    ]),
                ],

            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $this->page->fill($request->get('page'))->save();

        $title_operation = $this->page->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.page.edit',$this->page->id);
    }
    public function remove()
    {

        $this->page->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.page.list');
    }
}
