<?php

namespace App\Orchid\Layouts\Product;

use App\Models\Product;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Actions\Menu;
class ProductListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    public $target = 'product';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->sort()->width(30),
            TD::make('img', __('Image'))->width(50)
                ->render(function (Product $product) {
                    return '<img src="'.$product->image.'" width="65px;">';
                }),   
            TD::make('name_ua', __("Name"))->width(620), 
            TD::make('categories', __('Catogories'))
                ->render(function (Product $product) {
                    if($product->categories->first->getRootCategory()) {
                         return   $product->categories->first->getRootCategory()->name_ua;
                    } else {
                         return  "";
                    }
                   
                }),
            TD::make('brand_id', __('Brand'))

                ->render(function (Product $product) {
                    return $product->brand->name_ua ?? '-';
                }),
            TD::make('packs', __('Price'))

                ->render(function (Product $product) {
                    return $product->packs() ? ceil($product->packs()->min('volume') * $product->price) .' грн.' : $product->price.' грн.';
                }),
            TD::make('publish', __('Status'))->width(80)
                ->render(function (Product $product) {
                    if ($product->is_publish==1) {
                        return "<span class=\"badge bg-success  text-white\" >".__('Active')."</span>";
                    } else {
                        return "<span class=\"badge bg-danger text-white\">".__('No active')."</span>";
                    }
                
                }),      
            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->width(120)
                ->sort()
                ->align(TD::ALIGN_RIGHT),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Product $product) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.product.edit', $product->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove_product', [
                                'id' => $product->id,
                            ]),

                    ])),

        ];
    }
}
