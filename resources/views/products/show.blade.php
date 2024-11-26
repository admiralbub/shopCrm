<x-layouts.app  
    :title="$product->meta_title_parsed"
    :descriptions="$product->meta_description_parsed"
    :keywords="''">

    <div class="container mb-5">
        <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>
        <div class="show_phoduct py-2">
            <div class="row">
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="show_phoduct-img">
                        <img src="{{ asset($product->image)}}" class="img-fluid" >
                    </div>       
                </div>
                <div class="col-12 col-lg-6 col-md-12 pt-2">
                    <div class="show_phoduct-heading">
                        <h1 class="fs-3">{{$product->h1_parsed}}</h1>
                    </div>
                    <div class="show_phoduct-rating pt-2">
                        <div class="show_phoduct-rating-icon">
                            <div class="rating" data-rate-value=" {{$product->feedback->avg('rating')}}"></div>
                                  
                        </div>
                        <div class="show_phoduct-rating-count">
                            <div class="count-text">
                                {{$product->feedback->count()}} {{__('Reviews')}}
                            </div>
                        </div>
                        
                    </div>
                    <div class="show_phoduct-status pt-3">
                        <span class="{{$product->status_available ? 'status-stock' : 'status-no'}}">
                            {{$product->status_text}}
                           
                                  
                        </span>
                         
                    </div>
                    @if ($product->stocks)
                        <div class="show_phoduct-oldprice mt-3">
                            <span>{{ ceil(($product->packs->count() > 0 ? $product->packs->first()->volume : 1)  * $product->price) }} {{__("uah")}}</span>
                        </div>
                    @endif 
                    <div class="show_phoduct-price @if(!$product->stocks) pt-3 @endif fs-2">
                        @if ($product->stocks)
                            <strong>{{ ceil(($product->packs->count() > 0 ? $product->packs->first()->volume : 1)  * $product->price_stock) }} {{__("uah")}}</strong>
                        @else
                            <strong>{{ ceil(($product->packs->count() > 0 ? $product->packs->first()->volume : 1)  * $product->price) }} {{__("uah")}}</strong>
                        @endif   
                    
                    </div>
                    @if ($product->stocks)
                        <span class="text-danger fw-bold"> {{__("discount_price_title")}} - {!! $product->price_stock !!} {{__("uah")}}/{{ $product->unit_string }}</span>
                    @else
                        <span class="fw-normal">{!! $product->price !!} {{__("uah")}}/{{ $product->unit_string }}</span>
                    @endif
                    <div class="show_phoduct-choice pt-3">
                        <div class="row">
                            <div class="col-12 col-lg-3 fs-6 pt-2">
                                <strong>{{__('Pack')}}</strong>
                            </div>
                            <div class="col-12 col-lg-9">
                                <select  class="form-select pack_select w-100 w-lg-50" id="pack_{{$product->id}}" aria-label="Default select example" >
                                    @foreach($product->packs as $pack)
                                        <option value="{{ $pack->volume }}" id="{{ $pack->id }}" data-price="{{ $pack->volume * $product->price }}" >{{ $pack->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row pt-2 pb-2">
                            <div class="col-12 col-lg-3 fs-6 pt-2">
                                <strong>{{__('Brand')}}</strong>
                            </div>
                            <div class="col-12 col-lg-9 pt-2">
                                {{$product->brand->name}}
                            </div>
                        </div>
                        @if($attrs->count())
                            @foreach($attrs as $groupName => $attributes)
                                <div class="row pt-2 pb-3">
                                    <div class="col-12 col-lg-3 fs-6 pt-2">
                                        <strong>{{$groupName}}</strong>
                                    </div>
                                    <div class="col-12 col-lg-9 pt-2">
                                        @foreach ($attributes as $attr) 
                                            {{ $attr->name }}
                                            @if(!$loop->last) | @endif
                                        @endforeach
                                    </div>
                                </div>            
                            @endforeach
                        @endif
                        
                        
                    </div>
                  
                    
                    @if($product->status_available)
                        <div class="show_phoduct-manage py-4">
                            <div class="show_phoduct-manage_quantity">
                                <div class="quantity">
                                    <div class="quantity-button minus">
                                        
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                        </svg>
                                            
                                    </div>
                                    <input type="text"  id="qty" class="input-text qty text" name="quantity" value="1" size="4" min="1" max="" step="1" placeholder="" inputmode="numeric" autocomplete="off">
                                        
                                    <div class="quantity-button plus">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                            
                                            
                                    </div>
                                </div>
                            </div>
                            <div class="show_phoduct-manage_addbasket">
                                <button class="btn btn-primary px-5 py-2" data-id="{{$product->id}}" data-packid="{{$product->packs->first()->id}}" id="AddBasketView">{{__('Add to cart')}}</button>
                            </div>
                            <div class="show_phoduct-manage_oneclick d-none">
                                <button class="btn btn-light px-5">{{__('Buy in 1 click')}}</button>
                            </div>
                        </div>
                    @endif
                    <div class="show_phoduct-panel">
                        <button class="show_phoduct-panel_favorite" id="AddWislistShow" data-id="{{$product->id}}" data-auth="{{auth()->check() ? '1' : '0'}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                                  
                            <span>{{__('Wishlist')}}</span>
                        </button>
                        <button class="show_phoduct-panel_scale" id="AddCompareShow" data-id="{{$product->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
                            </svg>
                                  
                                  
                            <span>{{__('Compare')}}</span>
                        </button>
                    </div>
                    <div class="show_phoduct-notices">
                        <ul>
                            <li>
                                <div class="notice-icon">
                                    <i class="bi bi-credit-card"></i>

                                </div>
                                <div class="notice-text">
                                    <p><strong>Payment.</strong> Payment upon receipt of goods, Payment by card in the department, Google Pay, Online card, -5% discount in case of payment</p>
                                </div>
                            </li>
                            <li>
                                <div class="notice-icon">
                                    <i class="bi bi-mailbox"></i>

                                            
                                </div>
                                <div class="notice-text">
                                    <p><strong>Deliver.</strong> Pickup from Pervomaysk, Stepnaya st. 12B, Nikolaev region (Free)</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            @auth
              
                @if(!empty(auth()->user()->permissions))
                    <a href="/admin/products/{{$product->id}}/edit" target="_blank" class="primary">
                        <i class="bi bi-pencil-fill"></i>

                        <span>{{__('Edit')}}</span>
                    </a>
                @endif
            @endif
        </div>
        <div class="tp-product-details mt-5">
            <nav>
                <div class="nav nav-tabs  justify-content-center" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab" data-bs-target="#nav-description" type="button" role="tab" aria-controls="nav-home" aria-selected="true">{{__('description_two')}}</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">({{$product->feedback->count()}}) {{__('Reviews')}}</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                    <div class="description-tab mt-2">
                        {!! $product->description !!}
                    </div>
                        
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="reviews-tab mt-2 ">
                        <div class="row g-3 mt-4">
                            <div class="col-12 col-lg-7 col-md-12">
                                <div class="reviews-tab-bb">
                                    <h4>{{__('Feedbacks')}}</h4>    
                                    
                                    <div class="reviews-lists mt-4">
                                        @if(count($feedbacks)>0)
                                            @foreach($feedbacks as $feedback)
                                                <x-feedback.feedbacks :feedback="$feedback"></x-feedback.feedbacks>
                                            @endforeach
                                        @else
                                            <p>{{__('There are no reviews for this product at this time')}}</p>
                                        @endif
                                    </div>  
                                </div>
                            </div>
                            <div class="col-12  col-lg-5 col-md-12">
                                 <x-feedback.form :id="$product->id" :slug="$product->slug"></x-feedback.form>
                            </div>
                                    
                        </div> 
                    </div> 
                </div>
            </div>
           
        </div>
    </div>
   
</x-layouts.app>