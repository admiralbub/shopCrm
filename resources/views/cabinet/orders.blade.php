<x-layouts.app  
    :title="__('My order')"
    :descriptions="__('My order')"
    :keywords="__('My order')">

    <div class="account container py-5">
        <div class="row">
            <div class="col-lg-3">
                <x-cabinet.menu/>
            </div>
            <div class="col-lg-9">
                <div class="account_heading">
                    <h1 class="fs-4">{{__('My order')}}</h1>    
                </div>
                @if(count($orders)>0)
                    @foreach($orders as $order)
                        <div class="accordion mt-3" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button position-relative" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$order->id}}" aria-expanded="true" aria-controls="collapseOne">
                                        @if($order->status==0)
                                    
                                            <div class="status_deliver default"></div>
                                        @elseif($order->status==1)
                                    
                                            <div class="status_deliver work"></div>

                                        @elseif($order->status==2)
                                    
                                            <div class="status_deliver to_pay"></div>

                                        @elseif($order->status==3)
                                    
                                            <div class="status_deliver success_pay"></div>

                                        @elseif($order->status==4)
                                    
                                            <div class="status_deliver success"></div>

                                        @elseif($order->status==5)
                                    
                                            <div class="status_deliver cancel"></div>
                                        @endif
                                        
                                        <div class="d-flex">
                                            <div class="px-4">
                                                <span>
                                                    <strong>№ {{$order->id}}</strong> {{__('from')}} {{$order->created_at}}
                                                </span>
                                                <div class="pt-2">
                                                    {{$order->status_text}}
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </button>
                                </h2>
                                <div id="collapse{{$order->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row py-3 px-2">
                                            <div class="col-lg-5 pt-2">
                                                <div class="pb-2">
                                                    <span class="text-uppercase">{{__('Info deliver')}}</span>
                                                    <div class="pt-2">
                                                        <span class="fs-6">
                                                            @if($order->deliver_type)
                                                                @if($order->deliver_type=="NP")
                                                                    {{$order->deliver_name}} {{$order->np_city}} {{$order->np_warehouse}}
                                                                @endif
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="pt-3">
                                                    <span class="text-uppercase">{{__('Payment')}}</span>
                                                    <div class="pt-2">
                                                        <span class="fs-6">
                                                            @if($order->pay_type)
                                                                @if($order->pay_type=="Default_pay")
                                                                    {{$order->pay_title}} 
                                                                @endif
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="pt-3">
                                                    <span class="text-uppercase">{{__('total')}}</span>
                                                    <div class="pt-2">
                                                        <span class="fs-5 fw-semibold">{{$order->total}} {{__("uah")}}</span>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col col-lg-7">
                                                <div class="table-orderAccount">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"></th>
                                                                <th scope="col">{{__('Goods')}}</th>
                                                                <th scope="col">{{__('Pack')}}</th>
                                                                <th scope="col">{{__('Price')}}</th>
                                                                <th scope="col">{{__('Quantity')}}</th>
                                                            
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order->products as $product)
                                                                <tr>
                                                                    <td class="image">
                                                                        <img src="{{asset($product->image)}}" alt=""  class="image" >
                                                                    </td>
                                                                    <td class="name_product">
                                                                        <a href="{{route('product.view',['slug'=>$product->slug])}}">{{$product->name}}</a>
                                                                    </td>
                                                                    <td class="pack_name text-nowrap">{{$product->packs()->first()->name}}</td>
                                                                    <td>
                                                                        <div class="history_orders text-nowrap">
                                                                            {{$product->pivot->price}} 
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="count_orders">
                                                                            {{$product->pivot->quantity}}
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="pt-3">
                        <p class="fs-5">{{__('You have no orders')}}</p>
                    </div>
                    
                @endif
            </div>
        </div>
    </div>
    
</x-layouts.app>
