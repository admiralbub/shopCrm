<?php

namespace App\Orchid\Screens\Order;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Orchid\Layouts\OrderProduct\OrderProductListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\Picture;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Menu;
use Orchid\Screen\Fields\Select;

use App\Orchid\Fields\CityNpRef;
use App\Orchid\Fields\WarehouseNp;
use App\Orchid\Fields\WarehouseNpRef;
use App\Orchid\Fields\CityNp;

use App\Orchid\Layouts\Deliver;
use App\Orchid\Layouts\Deliver\DeliverListener;
class OrderEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $order;
    public $order_product;
    public function query(Order $order): array
    {
        return [
            'order' => $order,
            'order_product' => OrderProduct::where('order_id',$order->id)->get()
            
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __("Edit order",["number"=>$this->order->id]);
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [


            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->order->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->order->exists),
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
                Input::make('order.first_name')
                    ->required()
                    ->title('firstName_title'),

                Input::make('order.last_name')
                    ->required()
                    ->title('lastName_title'),

                Input::make('order.middle_name')
                    ->title('MiddleName_title'),

                Input::make('order.phone')
                    ->type('text')
                    ->required()
                    ->title(__('Phone_title'))
                    ->mask('+38(999) 999-99-99')
                    ->placeholder(__('Phone_title')),

                Input::make('order.email')
                    ->required()
                    ->title('Email'),
                Select::make('order.status')
                    ->options(Order::getStatusUnitAttribute())
                    ->required()
                    ->title(__('Status')), 
                
                Select::make('order.deliver_type')
                    ->options(Order::getDeliverTextAttribute())
                    ->required()
                    ->title(__('Deliver')), 
                CityNp::make('order.np_city')
                    ->title(__('City')),
                CityNpRef::make('order.np_city_ref'),

                    

                WarehouseNp::make('order.np_warehouse')
                    ->title(__('Warehouse')),

                WarehouseNpRef::make('order.np_warehouse_ref'),
                
                    
                TextArea::make('order.comment')
                    ->title(__('Notes to the order'))
                


            ]),
            OrderProductListLayout::class
        ];
    }
    public function asyncDeliver(Order $order) {
        return [
            'order'=>$order
        ];
    }
    public function createOrUpdate(Request $request)
    {
       // dd($request->get('order')['deliver_name']);
        $delivery['city_np'] = $request->get('order')['np_city'];
        $delivery['warehouse_np'] = $request->get('order')['np_warehouse'];
        $delivery['warehouse_ref'] = $request->get('order')['np_warehouse_ref'];
        $delivery['deliver'] = $request->get('order')['deliver_type'];
        $delivery['city_ref'] = $request->get('order')['np_city_ref'];
        $this->order->delivery = $delivery;



        $this->order->fill($request->get('order'))->save();

        $title_operation = $this->order->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.order.edit',$this->order->id);
    }
    public function remove()
    {

        $this->order->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.order.list');
    }
}