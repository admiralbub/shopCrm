<?php

namespace App\Orchid\Screens\Product;

use App\Models\Category;
use App\Models\Attr;
use App\Models\Product;
use App\Models\Price;
use App\Models\Brand;
use App\Models\Pack;
use App\Models\Stock;
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
use Orchid\Screen\Actions\Menu;
use Nakipelo\Orchid\CKEditor\CKEditor;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\CheckBox;

class ProductEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $product;
    public function query(Product $product): array
    {
        return [
            'product' => $product
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->product->exists ? __("Edit product") : __("Add product");
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make( __("Add product"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->product->exists),
            Button::make( __("Edit product"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->product->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->product->exists),
            Menu::make(__('Show'))
                ->icon('bs.eye-fill')
                ->canSee($this->product->exists)
                ->url('/product/'.$this->product->slug), 
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
                        Input::make('product.name_ru')
                            ->required()
                            ->title(__('Heading',['locale'=>'(ru)'])),
                        Input::make('product.name_ua')
                            ->required()
                            ->title(__('Heading',['locale'=>'(ua)'])),
                        Picture::make('product.image')
                            ->title(__('Main image'))
                            ->required()
                            ->storage('images_product'), 
                            
                        
                        Upload::make('product.attachment')
                            ->title(__('Additional images'))
                            ->groups("images")
                            ->closeOnAdd(),    
                        Select::make('product.categories')
                            ->fromModel(Category::where('status','=',1), 'name_ua')
                            ->required()
                            ->multiple()
                            ->title(__('Catogories')),
                        Select::make('product.brand_id')
                            ->fromModel(Brand::where('status','=',1), 'name_ua')
                            ->required()
                            ->empty(__('Select the required item'))
                            ->title(__('Brand')),

                        Select::make('product.unit')
                            ->options([
                                 
                                1 => __('liter'),
                                2 => __('bag'),
                                3 => __('tones'),
                                4 => __('kg'),
                                5 => __('thing'),
                            
                            ])
                            ->title(__('Price for')),    
                        Select::make('product.status')
                            ->options(Product::getStatusUnitAttribute())
                            ->required()
                            ->title(__('Product availability')), 
                        CheckBox::make('product.is_new')
                            ->sendTrueOrFalse()
                            ->title(__('New product')),
                        CheckBox::make('product.is_top')
                            ->sendTrueOrFalse()
                            ->title(__('Popular product')),
                        CheckBox::make('product.is_recommender')
                            ->sendTrueOrFalse()
                            ->title(__('Recommended product')),
                        CheckBox::make('product.is_sale')
                            ->sendTrueOrFalse()
                            ->title(__('Sale')),
                        CheckBox::make('product.hide_from_categories')
                            ->sendTrueOrFalse()
                            ->title(__('Do you want to grab a product from the category?')),              
                        Input::make('product.price')
                            ->title(__('Price'))
                            ->required(),   
                        Select::make('product.page_id')
                            ->fromModel(Page::class, 'name_ua')
                            ->empty(__('Select the required item'))
                            ->title(__('Product pages')),    
                        Input::make('product.old_price')
                            ->title(__('Old price')),           

                        CKEditor::make('product.description_ua')
                            ->title(__('Description',['locale'=>'(ua)']))
                            ->required()
                            ->rows(5),
                                
                        CKEditor::make('product.description_ru')
                            ->title(__('Description',['locale'=>'(ru)']))
                            ->required()
                            ->rows(5),
                        CheckBox::make('product.is_publish')
                            ->sendTrueOrFalse()
                            ->title(__('Publish')),
                    ])
                ],
                __('Stocks') => [
                    Layout::rows([
                        Select::make('product.stock_id')
                            ->fromModel(Stock::where('status','=',1), 'name_ua')
                            ->empty(__('Select the required item'))
                            ->allowAdd()
                            ->title(__('Stocks')),    
                        /*Input::make('product.price_stock')
                            ->title('Акційна ціна (грн)'),   */
                        
                        
                    ])
                ],
                __('Pack') => [
                    Layout::rows([
                        Select::make('product.packs')
                            ->fromModel(Pack::where('status','=',1), 'name_ua')
                            ->multiple()
                            ->required()
                            ->empty(__('Select the required item'))
                            ->title(__('Pack')),

                        
                    ])
                ],  
                __('Attribute') => [
                    Layout::rows([
                        Select::make('product.attrs')
                            ->fromModel(Attr::where('status','=',1), 'name_ua')
                            ->multiple()
                            ->title(__('Attribute')),
                    ])
                ],
                __('Wholesale prices') => [
                     Layout::rows([
                          Input::make('product.wholesale_p3')
                                ->title(__('Wholesale from 5 piece')),   
                          Input::make('product.wholesale_p10')
                                ->title(__('Wholesale from 20 pieces')),   
                          Input::make('product.wholesale_p11')
                                ->title(__('Wholesale price per liter')),   
                          Input::make('product.wholesale_p12')
                                ->title(__('Wholesale purchase from liter')),   
                          Input::make('product.wholesale_p13')
                                ->title(__('Wholesale price per kg, bag, ton')),   
                          Input::make('product.wholesale_p14')
                                ->title(__('Wholesale purchase from kg, bag, ton')),  
                     ]),

                 ],
               
                 
                'SEO' => [
                    Layout::rows([
                        Input::make('product.h1_ru')
                            ->title('H1 (ru)'),
                        Input::make('product.h1_ua')
                            ->title('H1 (ua)'),

                        Input::make('product.meta_title_ru')
                            ->title('Title (ru)'),
                        Input::make('product.meta_title_ua')
                            ->title('Title (ua)'),
                        TextArea::make('product.meta_description_ru')
                            ->title('Meta description (ru)')
                            ->rows(5),
                        TextArea::make('product.meta_description_ua')
                            ->title('Meta description (ua)')
                            ->rows(5),

                         TextArea::make('product.meta_keywords_ru')
                            ->title('Keywords (ru)')
                            ->rows(5),
                        TextArea::make('product.meta_keywords_ua')
                            ->title('Keywords (ua)')
                            ->rows(5),
                    ]),
                ],
            ])
        ];
    }
    public function createOrUpdate(Request $request)
    {
    
        $wholesale['p3'] = $request->get('product')['wholesale_p3'];
        $wholesale['p10'] = $request->get('product')['wholesale_p10'];
        $wholesale['p11'] = $request->get('product')['wholesale_p11'];
        $wholesale['p12'] = $request->get('product')['wholesale_p12'];
        $wholesale['p13'] = $request->get('product')['wholesale_p13'];
        $wholesale['p14'] = $request->get('product')['wholesale_p14'];
        $this->product->wholesale = $wholesale;


        /*$attr['cult'] = $request->get('product')['attr_cult'];
        $attr['sub'] = $request->get('product')['attr_sub'];
        $attr['analog'] = $request->get('product')['attr_analog'];
        $product->attr = $attr;*/


        //dd($request->get('product'));
        $this->product->unit = $request->get('product')['unit'];
        
        //$product->categories = $request->get('product')['categories'];
        //dd($request->get('product')['categories']);

        $this->product->fill($request->get('product'))->save();



        $this->product->categories()->sync($request->get('product')['categories']);

        $this->product->packs()->sync($request->get('product')['packs']);


      //  dd($request->get('product')['attrs']);

        if ($request->filled('product.attrs')) {
            $this->product->attrs()->sync($request->get('product')['attrs']);
        }
        

        $title_operation = $this->product->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);
        return redirect()->route('platform.product.edit',$this->product->id);
    }

    
    public function remove()
    {


         $this->product->delete();

         Toast::info(__('You have successfully performed the delete operation.'));
         return redirect()->route('platform.products.list');
    }

}
