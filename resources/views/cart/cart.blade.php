<x-layouts.app  
    :title="__('Placing an order')"
    :descriptions="''"
    :keywords="''">
    <div class="container mb-5 mt-5 ">
        <h1 class="fs-3">{{__('Placing an order')}}</h1>
        <div class="row mt-5">
            <div class="col-12 col-lg-8">
                <div class="orders">
                    <form method="POST" role="form" action="{{route('order.post')}}" id="form">  
                        @csrf
                        <div class="form-block mb-7 ">
                            <div class="label d-flex mb-3 ">
                                <div class="label_item">
                                    <span>1</span>
                                </div>
                                <div class="label_item">
                                    <span>{{__('Your contact information')}}</span>
                                </div>
                            </div>
                            <div class="mt-4 row">
                                <label class="col-sm-3 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('lastName_title')}}  <span style="color:red; font-size: 14px;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" data-require="true" data-max="256" class="form-control" id="surname" name="last_name" value="{{auth()->check() ? auth()->user()->last_name : ''}}">
                                </div>
                            </div>
                            <div class="mt-3 row">
                                <label class="col-sm-3 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('firstName_title')}}  <span style="color:red; font-size: 14px;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" data-require="true" data-max="256"  class="form-control" id="name" name="first_name" value="{{auth()->check() ? auth()->user()->first_name : ''}}">

                                </div>
                            </div>
                            <div class="mt-3 row">
                                <label class="col-sm-3 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('MiddleName_title')}} </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{auth()->check() ? auth()->user()->middle_name : ''}}">


                                </div>
                            </div>        
                            <div class="mt-3 row">
                                <label class="col-sm-3 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Phone_title')}} <span style="color:red; font-size: 14px;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="tel" data-require="true" data-max="256"  class="form-control tel" id="phone" name="phone" value="{{auth()->check() ? auth()->user()->phone : ''}}">


                                </div>
                            </div>  
                            <div class="mt-3 row">
                                <label class="col-sm-3 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Email')}} <span style="color:red; font-size: 14px;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="email" data-require="true" data-max="256"  class="form-control" id="email" name="email" value="{{auth()->check() ? auth()->user()->email : ''}}">


                                </div>
                            </div>  
                            
                            <div class="mt-3 row mb-3">
                                <label class="col-sm-3 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Notes to the order')}}</label>
                                <div class="col-sm-9">
                                    <textarea data-require="true" data-max="256"  class="form-control" name="notes_order" id="notes_order" rows="2"></textarea>
                                </div>
                            </div> 
                           
                           
                        </div>
                        
                        
                        <div class="form-block row mt-3 ">
                            <div class="label d-flex ">
                                <div class="label_item">
                                    <span>2</span>
                                </div>
                                <div class="label_item">
                                    <span>{{__('Deliver')}}</span>
                                </div>
                            </div>    
                            <div class="mt-3 row mb-3">
                                <label for="Deliver" class="col-sm-4 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Carrier')}}</label>
                                <div class="col-sm-8">
                                    <select class="form-select"  data-require="true" name="deliver" id="deliver">
                                        <option selected value="">---</option>
                                        <option value="NP">{{__('Nova Poshta')}}</option>
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="mt-3 row mb-3 d-none" id="np_city_block">
                                <label for="Deliver" class="col-sm-4 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('City')}}</label>
                                <div class="col-sm-8 position-relative">
                                    <input type="text" data-require="true" data-max="256" placeholder="{{__('Write and select a city')}}"  class="form-control position-relative d-none" id="np_city_input" name="city_np" value="">
                                    
                                    <input type="text" id="city_ref_np" name="city_ref_np" hidden>

                                    <div class="close_input position-absolute" id="clear_city_np">&times;</div>
                                    <div class="resusltInput position-absolute bg-light py-3 px-2 z-3 d-none resusltCityNp">
                                        <ul id="resusltCityNp">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 row mb-3 d-none" id="np_warehouse_block">
                                <label for="Deliver"  class="col-sm-4 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Warehouse')}}</label>
                                <div class="col-sm-8 position-relative">
                                    <input type="text" data-require="true" data-max="256"  placeholder="{{__('All branches')}}" class="form-control d-none" id="warehouse_input" name="warehouse_np" value="" readonly>
                                    <input type="text" id="warehouse_ref_np" name="warehouse_ref_np" value="" hidden>
                                    <div class="close_input position-absolute" id="clear_warehouse_np">&times;</div>
                                    <div class="resusltInput position-absolute bg-light py-3 px-2 z-3 d-none resusWarehouseNp">
                                        <ul id="resusltWarehouseNp">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-block row mt-3 ">
                            <div class="label d-flex ">
                                <div class="label_item">
                                    <span>3</span>
                                </div>
                                <div class="label_item">
                                    <span>{{__('Payment')}}</span>
                                </div>
                            </div>    
                            <div class="mt-3 row mb-3">
                                <label for="Deliver" class="col-sm-4 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Payment method')}}</label>
                                <div class="col-sm-8">
                                    <select class="form-select" aria-label="Default select example" data-require="true" name="pay">
                                        <option selected value="">---</option>
                                        <option value="Default_pay">{{__('Payment per hour of picking up the goods')}} </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-md-flex justify-content-md-end">
                            <button  type="submit" class="btn btn-primary py-2 fw-bold btn-lg" >{{__('Placing an order')}}</button>
                
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                
                <div class="order_summ">
                   
                    <div class="order_summ-heading">
                        <span class="fs-2">{{__('Basket')}}</span>
                    </div>
                    
                    <ul class="order_summ-orders" id="showTableCart">
                       
                    </ul>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="label_goods">
                            <span class="label_goods_total">2</span> {{__('product(s)')}}
                        </div>
                        
                    </div>
                    <div class="order_summ-total pt-3">
                        <div class="label_goods d-flex justify-content-between">
                            <div class="label_goods-item">
                                <span>{{__('Conclusion')}}</span>
                            </div>
                            <div  class="label_goods-item" id="TotalBasketOrder">
                                <span>1200 грн.</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
               
            </div>
        </div>
    </div>
</x-layouts.app>