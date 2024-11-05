<x-layouts.app  
    :title="__('Basket')"
    :descriptions="''"
    :keywords="''">
    <div class="container mb-5">
        
        <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>
        <div class="mt-1 cart">
            @if(count($baskets)>0)
                <h1 class="fs-2">{{__('Basket')}}</h1>
                <div class="row">
                    <div class="col col-lg-9">
                        <div class="mt-5">
                            <table class="table table-hover table-responsive">
                                <thead>
                                    <tr class="pb-3">
                                        <th scope="col"></th>
                                        <th scope="col">{{__('Product')}}</th>
                                        <th scope="col">{{__('Pack')}}</th>
                                        <th scope="col">{{__('Quantity')}}</th>
                                        <th scope="col">{{__('Price')}}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($baskets as $basket)
                                        <tr>
                                            <td>
                                                <a href="{{route('product.view',['slug'=>$basket->slug])}}" class="fs-6">
                                                    <img src="{{asset($basket->image)}}" alt=""  class="product-image">
                                                </a>
                                            </td>
                                            <td class="pt-4">
                                                <a href="{{route('product.view',['slug'=>$basket->slug])}}" class="fs-6">
                                                    {{$basket->name}}
                                                </a>
                                            </td>
                                            <td class="fs-6 pt-4">
                                                {{$basket->pack_name}}
                                            </td>
                                            <td class="fs-6 pt-4">
                                                {{$basket->quantity}}
                                            </td>
                                            <td class="fs-6 pt-4">
                                                {{$basket->price}} {{__('uah')}}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-light deleteBasket" data-id="{{$basket->id_basket}}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col col-lg-3 mt-4">
                        <div class="orders_summa px-4 py-3">
                            <div class="orders_summa_together d-flex align-items-center justify-content-between">
                                <span class="orders_summa_together-title">
                                    {{__('Conclusion')}}
                                </span>
                                <span class="orders_summa_together-summ">
                                    {{$totalBasket}} {{__('uah')}}
                                </span>
                            </div>
                            <div class="orders_summa-btn">
                                <div class="d-grid gap-2">
                                    <a href="#" class="btn btn-primary btn-lg fw-bold">
                                        {{__('Continue shopping')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            @else
                <h1 class="fs-2">{{__('Cart is empty')}}</h1>
            @endif
        </div>
    </div>
</x-layouts.app>