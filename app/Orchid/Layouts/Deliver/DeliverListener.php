<?php

namespace App\Orchid\Layouts\Deliver;

use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use App\Models\Order;
use App\Models\NpCity;
use App\Models\NpWarehouse;

class DeliverListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
        'order.deliver_type',
        'order.np_city_id',
        'order'
    ];

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    protected function layouts(): array
    {
        return [
            Layout::rows([
                Select::make('order.deliver_type')
                    ->options(Order::getDeliverTextAttribute())
                    ->required()
                    ->title(__('Deliver')), 

                Relation::make('order.np_city_id')
                    ->fromModel(NpCity::class, 'Description')
                    ->allowEmpty()
                    ->title(__('City')),

                Relation::make('order.np_warehouse_id')
                    ->fromModel(NpWarehouse::class, 'Description')
                    ->applyScope('Ref',$this->query->get('order.np_city_id'))
                    ->allowEmpty()
                    ->canSee($this->query->get('order.deliver_type')==="NP")
                    ->title(__('Warehouse')),
              
            ]),
        ];
    }

    /**
     * Update state
     *
     * @param \Orchid\Screen\Repository $repository
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Orchid\Screen\Repository
     */
    public function handle(Repository $repository, Request $request): Repository
    {

        return $repository
            ->set('order.deliver_type', $request->input('order.deliver_type'))
            
            ->set('order.np_city_id', $request->input('order.np_city_id'))
            ->set('order', $request->input('order'));
    }
}
