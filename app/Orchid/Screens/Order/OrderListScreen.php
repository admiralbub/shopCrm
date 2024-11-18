<?php

namespace App\Orchid\Screens\Order;

use Orchid\Screen\Screen;
use App\Models\Order;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Order\OrderListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;



class OrderListScreen extends Screen
{
   
    public function query(): iterable
    {
        return [
            'order' => Order::filters()->orderBy('id','DESC')->defaultSort('id')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __("Order");
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            OrderListLayout::class
        ];
    }
    public function remove_order(Request $request): void
    {
        Order::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
