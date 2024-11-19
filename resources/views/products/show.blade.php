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
                            <svg viewBox="0 0 12 12" focusable="false" class="chakra-icon css-kkxboy" data-testid="reviewStar"><path d="M3.33385 10.9017L5.9998 9.29648L8.66575 10.9017C8.78353 10.9766 8.90665 11.0087 9.03513 10.998C9.16361 10.9873 9.27603 10.9445 9.37239 10.8696C9.46875 10.7947 9.5437 10.7011 9.59723 10.589C9.65077 10.4764 9.66147 10.3506 9.62935 10.2114L8.92271 7.17762L11.2835 5.13902C11.3906 5.04271 11.4576 4.93291 11.4846 4.80964C11.5112 4.68678 11.503 4.5665 11.4602 4.44879C11.4174 4.33107 11.3531 4.23476 11.2675 4.15985C11.1818 4.08494 11.064 4.03679 10.9142 4.01538L7.79852 3.7425L6.59402 0.885248C6.54049 0.756832 6.45762 0.66052 6.34541 0.596312C6.23278 0.532104 6.11757 0.5 5.9998 0.5C5.88203 0.5 5.76704 0.532104 5.65483 0.596312C5.5422 0.66052 5.45911 0.756832 5.40558 0.885248L4.20108 3.7425L1.08545 4.01538C0.935557 4.03679 0.817784 4.08494 0.732131 4.15985C0.646477 4.23476 0.582238 4.33107 0.539411 4.44879C0.496584 4.5665 0.488661 4.68678 0.515642 4.80964C0.542195 4.93291 0.609004 5.04271 0.716071 5.13902L3.07689 7.17762L2.37025 10.2114C2.33813 10.3506 2.34883 10.4764 2.40237 10.589C2.4559 10.7011 2.53085 10.7947 2.62721 10.8696C2.72357 10.9445 2.83599 10.9873 2.96447 10.998C3.09295 11.0087 3.21607 10.9766 3.33385 10.9017Z"></path></svg>
                            <svg viewBox="0 0 12 12" focusable="false" class="chakra-icon css-kkxboy" data-testid="reviewStar"><path d="M3.33385 10.9017L5.9998 9.29648L8.66575 10.9017C8.78353 10.9766 8.90665 11.0087 9.03513 10.998C9.16361 10.9873 9.27603 10.9445 9.37239 10.8696C9.46875 10.7947 9.5437 10.7011 9.59723 10.589C9.65077 10.4764 9.66147 10.3506 9.62935 10.2114L8.92271 7.17762L11.2835 5.13902C11.3906 5.04271 11.4576 4.93291 11.4846 4.80964C11.5112 4.68678 11.503 4.5665 11.4602 4.44879C11.4174 4.33107 11.3531 4.23476 11.2675 4.15985C11.1818 4.08494 11.064 4.03679 10.9142 4.01538L7.79852 3.7425L6.59402 0.885248C6.54049 0.756832 6.45762 0.66052 6.34541 0.596312C6.23278 0.532104 6.11757 0.5 5.9998 0.5C5.88203 0.5 5.76704 0.532104 5.65483 0.596312C5.5422 0.66052 5.45911 0.756832 5.40558 0.885248L4.20108 3.7425L1.08545 4.01538C0.935557 4.03679 0.817784 4.08494 0.732131 4.15985C0.646477 4.23476 0.582238 4.33107 0.539411 4.44879C0.496584 4.5665 0.488661 4.68678 0.515642 4.80964C0.542195 4.93291 0.609004 5.04271 0.716071 5.13902L3.07689 7.17762L2.37025 10.2114C2.33813 10.3506 2.34883 10.4764 2.40237 10.589C2.4559 10.7011 2.53085 10.7947 2.62721 10.8696C2.72357 10.9445 2.83599 10.9873 2.96447 10.998C3.09295 11.0087 3.21607 10.9766 3.33385 10.9017Z"></path></svg>
                            <svg viewBox="0 0 12 12" focusable="false" class="chakra-icon css-kkxboy" data-testid="reviewStar"><path d="M3.33385 10.9017L5.9998 9.29648L8.66575 10.9017C8.78353 10.9766 8.90665 11.0087 9.03513 10.998C9.16361 10.9873 9.27603 10.9445 9.37239 10.8696C9.46875 10.7947 9.5437 10.7011 9.59723 10.589C9.65077 10.4764 9.66147 10.3506 9.62935 10.2114L8.92271 7.17762L11.2835 5.13902C11.3906 5.04271 11.4576 4.93291 11.4846 4.80964C11.5112 4.68678 11.503 4.5665 11.4602 4.44879C11.4174 4.33107 11.3531 4.23476 11.2675 4.15985C11.1818 4.08494 11.064 4.03679 10.9142 4.01538L7.79852 3.7425L6.59402 0.885248C6.54049 0.756832 6.45762 0.66052 6.34541 0.596312C6.23278 0.532104 6.11757 0.5 5.9998 0.5C5.88203 0.5 5.76704 0.532104 5.65483 0.596312C5.5422 0.66052 5.45911 0.756832 5.40558 0.885248L4.20108 3.7425L1.08545 4.01538C0.935557 4.03679 0.817784 4.08494 0.732131 4.15985C0.646477 4.23476 0.582238 4.33107 0.539411 4.44879C0.496584 4.5665 0.488661 4.68678 0.515642 4.80964C0.542195 4.93291 0.609004 5.04271 0.716071 5.13902L3.07689 7.17762L2.37025 10.2114C2.33813 10.3506 2.34883 10.4764 2.40237 10.589C2.4559 10.7011 2.53085 10.7947 2.62721 10.8696C2.72357 10.9445 2.83599 10.9873 2.96447 10.998C3.09295 11.0087 3.21607 10.9766 3.33385 10.9017Z"></path></svg>
                            <svg viewBox="0 0 12 12" focusable="false" class="chakra-icon css-kkxboy" data-testid="reviewStar"><path d="M3.33385 10.9017L5.9998 9.29648L8.66575 10.9017C8.78353 10.9766 8.90665 11.0087 9.03513 10.998C9.16361 10.9873 9.27603 10.9445 9.37239 10.8696C9.46875 10.7947 9.5437 10.7011 9.59723 10.589C9.65077 10.4764 9.66147 10.3506 9.62935 10.2114L8.92271 7.17762L11.2835 5.13902C11.3906 5.04271 11.4576 4.93291 11.4846 4.80964C11.5112 4.68678 11.503 4.5665 11.4602 4.44879C11.4174 4.33107 11.3531 4.23476 11.2675 4.15985C11.1818 4.08494 11.064 4.03679 10.9142 4.01538L7.79852 3.7425L6.59402 0.885248C6.54049 0.756832 6.45762 0.66052 6.34541 0.596312C6.23278 0.532104 6.11757 0.5 5.9998 0.5C5.88203 0.5 5.76704 0.532104 5.65483 0.596312C5.5422 0.66052 5.45911 0.756832 5.40558 0.885248L4.20108 3.7425L1.08545 4.01538C0.935557 4.03679 0.817784 4.08494 0.732131 4.15985C0.646477 4.23476 0.582238 4.33107 0.539411 4.44879C0.496584 4.5665 0.488661 4.68678 0.515642 4.80964C0.542195 4.93291 0.609004 5.04271 0.716071 5.13902L3.07689 7.17762L2.37025 10.2114C2.33813 10.3506 2.34883 10.4764 2.40237 10.589C2.4559 10.7011 2.53085 10.7947 2.62721 10.8696C2.72357 10.9445 2.83599 10.9873 2.96447 10.998C3.09295 11.0087 3.21607 10.9766 3.33385 10.9017Z"></path></svg>
                            <svg viewBox="0 0 12 12" focusable="false" class="chakra-icon css-kkxboy-notactive" data-testid="reviewStar"><path d="M3.33385 10.9017L5.9998 9.29648L8.66575 10.9017C8.78353 10.9766 8.90665 11.0087 9.03513 10.998C9.16361 10.9873 9.27603 10.9445 9.37239 10.8696C9.46875 10.7947 9.5437 10.7011 9.59723 10.589C9.65077 10.4764 9.66147 10.3506 9.62935 10.2114L8.92271 7.17762L11.2835 5.13902C11.3906 5.04271 11.4576 4.93291 11.4846 4.80964C11.5112 4.68678 11.503 4.5665 11.4602 4.44879C11.4174 4.33107 11.3531 4.23476 11.2675 4.15985C11.1818 4.08494 11.064 4.03679 10.9142 4.01538L7.79852 3.7425L6.59402 0.885248C6.54049 0.756832 6.45762 0.66052 6.34541 0.596312C6.23278 0.532104 6.11757 0.5 5.9998 0.5C5.88203 0.5 5.76704 0.532104 5.65483 0.596312C5.5422 0.66052 5.45911 0.756832 5.40558 0.885248L4.20108 3.7425L1.08545 4.01538C0.935557 4.03679 0.817784 4.08494 0.732131 4.15985C0.646477 4.23476 0.582238 4.33107 0.539411 4.44879C0.496584 4.5665 0.488661 4.68678 0.515642 4.80964C0.542195 4.93291 0.609004 5.04271 0.716071 5.13902L3.07689 7.17762L2.37025 10.2114C2.33813 10.3506 2.34883 10.4764 2.40237 10.589C2.4559 10.7011 2.53085 10.7947 2.62721 10.8696C2.72357 10.9445 2.83599 10.9873 2.96447 10.998C3.09295 11.0087 3.21607 10.9766 3.33385 10.9017Z"></path></svg>                                
                                  
                        </div>
                        <div class="show_phoduct-rating-count">
                            <div class="count-text">
                                3 {{__('Reviews')}}
                            </div>
                        </div>
                        
                    </div>
                    <div class="show_phoduct-status pt-3">
                        <span class="{{$product->status_available ? 'status-stock' : 'status-no'}}">
                            {{$product->status_text}}
                           
                                  
                        </span>
                         
                    </div>
                    
                    <div class="show_phoduct-price pt-3 fs-2">
                        <strong>{{ ceil($product->price * ($product->packs->count() > 0 ? $product->packs->first()->volume : 1)) }} {{__("uah")}}</strong>
                    </div>
                    <div class="show_phoduct-choice pt-3">
                        <div class="row">
                            <div class="col-12 col-lg-2 fs-6 pt-2">
                                <strong>{{__('Pack')}}</strong>
                            </div>
                            <div class="col-12 col-lg-10">
                                <select  class="form-select pack_select w-100 w-lg-50" id="pack_{{$product->id}}" aria-label="Default select example" >
                                    @foreach($product->packs as $pack)
                                        <option value="{{ $pack->volume }}" id="{{ $pack->id }}" data-price="{{ $pack->volume * $product->price }}" >{{ $pack->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row pt-2 pb-2">
                            <div class="col-12 col-lg-2 fs-6 pt-2">
                                <strong>{{__('Brand')}}</strong>
                            </div>
                            <div class="col-12 col-lg-10 pt-2">
                                {{$product->brand->name}}
                            </div>
                        </div>
                        @if($attrs->count())
                            @foreach($attrs as $groupName => $attributes)
                                <div class="row pt-2 pb-3">
                                    <div class="col-12 col-lg-2 fs-6 pt-2">
                                        <strong>{{$groupName}}</strong>
                                    </div>
                                    <div class="col-12 col-lg-10 pt-2">
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
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">(10) {{__('Reviews')}}</button>
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
                                    <h4>Reviews</h4>    
                                    <div class="reviews-lists mt-4">
                                            
                                        <div class="product_review-item ">
                                            <div class="product_review-item_img d-none d-lg-block">
                                                <img src="{{asset('images/img/no_photo.png')}}" alt="">  
                                            </div>
                                            <div class="product_review-item_content">
                                                <div class="product_review-item_head d-flex justify-content-between">
                                                    <div class="product_review-item_username">
                                                        Artheb
                                                    </div>
                                                    <div class="product_review-item_rating">
                                                        <div class="product_review-item_rating-icon">
                                                            <svg viewBox="0 0 12 12" focusable="false" class="chakra-icon css-kkxboy" data-testid="reviewStar"><path d="M3.33385 10.9017L5.9998 9.29648L8.66575 10.9017C8.78353 10.9766 8.90665 11.0087 9.03513 10.998C9.16361 10.9873 9.27603 10.9445 9.37239 10.8696C9.46875 10.7947 9.5437 10.7011 9.59723 10.589C9.65077 10.4764 9.66147 10.3506 9.62935 10.2114L8.92271 7.17762L11.2835 5.13902C11.3906 5.04271 11.4576 4.93291 11.4846 4.80964C11.5112 4.68678 11.503 4.5665 11.4602 4.44879C11.4174 4.33107 11.3531 4.23476 11.2675 4.15985C11.1818 4.08494 11.064 4.03679 10.9142 4.01538L7.79852 3.7425L6.59402 0.885248C6.54049 0.756832 6.45762 0.66052 6.34541 0.596312C6.23278 0.532104 6.11757 0.5 5.9998 0.5C5.88203 0.5 5.76704 0.532104 5.65483 0.596312C5.5422 0.66052 5.45911 0.756832 5.40558 0.885248L4.20108 3.7425L1.08545 4.01538C0.935557 4.03679 0.817784 4.08494 0.732131 4.15985C0.646477 4.23476 0.582238 4.33107 0.539411 4.44879C0.496584 4.5665 0.488661 4.68678 0.515642 4.80964C0.542195 4.93291 0.609004 5.04271 0.716071 5.13902L3.07689 7.17762L2.37025 10.2114C2.33813 10.3506 2.34883 10.4764 2.40237 10.589C2.4559 10.7011 2.53085 10.7947 2.62721 10.8696C2.72357 10.9445 2.83599 10.9873 2.96447 10.998C3.09295 11.0087 3.21607 10.9766 3.33385 10.9017Z"></path></svg>
                                                            <svg viewBox="0 0 12 12" focusable="false" class="chakra-icon css-kkxboy" data-testid="reviewStar"><path d="M3.33385 10.9017L5.9998 9.29648L8.66575 10.9017C8.78353 10.9766 8.90665 11.0087 9.03513 10.998C9.16361 10.9873 9.27603 10.9445 9.37239 10.8696C9.46875 10.7947 9.5437 10.7011 9.59723 10.589C9.65077 10.4764 9.66147 10.3506 9.62935 10.2114L8.92271 7.17762L11.2835 5.13902C11.3906 5.04271 11.4576 4.93291 11.4846 4.80964C11.5112 4.68678 11.503 4.5665 11.4602 4.44879C11.4174 4.33107 11.3531 4.23476 11.2675 4.15985C11.1818 4.08494 11.064 4.03679 10.9142 4.01538L7.79852 3.7425L6.59402 0.885248C6.54049 0.756832 6.45762 0.66052 6.34541 0.596312C6.23278 0.532104 6.11757 0.5 5.9998 0.5C5.88203 0.5 5.76704 0.532104 5.65483 0.596312C5.5422 0.66052 5.45911 0.756832 5.40558 0.885248L4.20108 3.7425L1.08545 4.01538C0.935557 4.03679 0.817784 4.08494 0.732131 4.15985C0.646477 4.23476 0.582238 4.33107 0.539411 4.44879C0.496584 4.5665 0.488661 4.68678 0.515642 4.80964C0.542195 4.93291 0.609004 5.04271 0.716071 5.13902L3.07689 7.17762L2.37025 10.2114C2.33813 10.3506 2.34883 10.4764 2.40237 10.589C2.4559 10.7011 2.53085 10.7947 2.62721 10.8696C2.72357 10.9445 2.83599 10.9873 2.96447 10.998C3.09295 11.0087 3.21607 10.9766 3.33385 10.9017Z"></path></svg>
                                                            <svg viewBox="0 0 12 12" focusable="false" class="chakra-icon css-kkxboy" data-testid="reviewStar"><path d="M3.33385 10.9017L5.9998 9.29648L8.66575 10.9017C8.78353 10.9766 8.90665 11.0087 9.03513 10.998C9.16361 10.9873 9.27603 10.9445 9.37239 10.8696C9.46875 10.7947 9.5437 10.7011 9.59723 10.589C9.65077 10.4764 9.66147 10.3506 9.62935 10.2114L8.92271 7.17762L11.2835 5.13902C11.3906 5.04271 11.4576 4.93291 11.4846 4.80964C11.5112 4.68678 11.503 4.5665 11.4602 4.44879C11.4174 4.33107 11.3531 4.23476 11.2675 4.15985C11.1818 4.08494 11.064 4.03679 10.9142 4.01538L7.79852 3.7425L6.59402 0.885248C6.54049 0.756832 6.45762 0.66052 6.34541 0.596312C6.23278 0.532104 6.11757 0.5 5.9998 0.5C5.88203 0.5 5.76704 0.532104 5.65483 0.596312C5.5422 0.66052 5.45911 0.756832 5.40558 0.885248L4.20108 3.7425L1.08545 4.01538C0.935557 4.03679 0.817784 4.08494 0.732131 4.15985C0.646477 4.23476 0.582238 4.33107 0.539411 4.44879C0.496584 4.5665 0.488661 4.68678 0.515642 4.80964C0.542195 4.93291 0.609004 5.04271 0.716071 5.13902L3.07689 7.17762L2.37025 10.2114C2.33813 10.3506 2.34883 10.4764 2.40237 10.589C2.4559 10.7011 2.53085 10.7947 2.62721 10.8696C2.72357 10.9445 2.83599 10.9873 2.96447 10.998C3.09295 11.0087 3.21607 10.9766 3.33385 10.9017Z"></path></svg>
                                                            <svg viewBox="0 0 12 12" focusable="false" class="chakra-icon css-kkxboy" data-testid="reviewStar"><path d="M3.33385 10.9017L5.9998 9.29648L8.66575 10.9017C8.78353 10.9766 8.90665 11.0087 9.03513 10.998C9.16361 10.9873 9.27603 10.9445 9.37239 10.8696C9.46875 10.7947 9.5437 10.7011 9.59723 10.589C9.65077 10.4764 9.66147 10.3506 9.62935 10.2114L8.92271 7.17762L11.2835 5.13902C11.3906 5.04271 11.4576 4.93291 11.4846 4.80964C11.5112 4.68678 11.503 4.5665 11.4602 4.44879C11.4174 4.33107 11.3531 4.23476 11.2675 4.15985C11.1818 4.08494 11.064 4.03679 10.9142 4.01538L7.79852 3.7425L6.59402 0.885248C6.54049 0.756832 6.45762 0.66052 6.34541 0.596312C6.23278 0.532104 6.11757 0.5 5.9998 0.5C5.88203 0.5 5.76704 0.532104 5.65483 0.596312C5.5422 0.66052 5.45911 0.756832 5.40558 0.885248L4.20108 3.7425L1.08545 4.01538C0.935557 4.03679 0.817784 4.08494 0.732131 4.15985C0.646477 4.23476 0.582238 4.33107 0.539411 4.44879C0.496584 4.5665 0.488661 4.68678 0.515642 4.80964C0.542195 4.93291 0.609004 5.04271 0.716071 5.13902L3.07689 7.17762L2.37025 10.2114C2.33813 10.3506 2.34883 10.4764 2.40237 10.589C2.4559 10.7011 2.53085 10.7947 2.62721 10.8696C2.72357 10.9445 2.83599 10.9873 2.96447 10.998C3.09295 11.0087 3.21607 10.9766 3.33385 10.9017Z"></path></svg>
                                                            <svg viewBox="0 0 12 12" focusable="false" class="chakra-icon css-kkxboy-notactive" data-testid="reviewStar"><path d="M3.33385 10.9017L5.9998 9.29648L8.66575 10.9017C8.78353 10.9766 8.90665 11.0087 9.03513 10.998C9.16361 10.9873 9.27603 10.9445 9.37239 10.8696C9.46875 10.7947 9.5437 10.7011 9.59723 10.589C9.65077 10.4764 9.66147 10.3506 9.62935 10.2114L8.92271 7.17762L11.2835 5.13902C11.3906 5.04271 11.4576 4.93291 11.4846 4.80964C11.5112 4.68678 11.503 4.5665 11.4602 4.44879C11.4174 4.33107 11.3531 4.23476 11.2675 4.15985C11.1818 4.08494 11.064 4.03679 10.9142 4.01538L7.79852 3.7425L6.59402 0.885248C6.54049 0.756832 6.45762 0.66052 6.34541 0.596312C6.23278 0.532104 6.11757 0.5 5.9998 0.5C5.88203 0.5 5.76704 0.532104 5.65483 0.596312C5.5422 0.66052 5.45911 0.756832 5.40558 0.885248L4.20108 3.7425L1.08545 4.01538C0.935557 4.03679 0.817784 4.08494 0.732131 4.15985C0.646477 4.23476 0.582238 4.33107 0.539411 4.44879C0.496584 4.5665 0.488661 4.68678 0.515642 4.80964C0.542195 4.93291 0.609004 5.04271 0.716071 5.13902L3.07689 7.17762L2.37025 10.2114C2.33813 10.3506 2.34883 10.4764 2.40237 10.589C2.4559 10.7011 2.53085 10.7947 2.62721 10.8696C2.72357 10.9445 2.83599 10.9873 2.96447 10.998C3.09295 11.0087 3.21607 10.9766 3.33385 10.9017Z"></path></svg>                                
                                                                    
                                                        </div>
                                                    </div>
                                                </div>   
                                                <div class="product_review-item_body">
                                                    <p>
                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                                    </p>
                                                </div>
                                                <div class="product_review-item_footer">
                                                    <i>26.10.2024 10:30</i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12  col-lg-5 col-md-12">
                                <div class="reviews-tab-form px-4">
                                    <h3>Add your review</h3>
                                    <span>Your email address will not be published. Required fields are marked *</span>   
                                    <form class="mt-3">
                                        <div class="mb-3">
                                            <label for="message" class="form-label">
                                                Your review 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control" id="message" rows="4"  required></textarea>
                                        </div>
                                            
                                        <div class="mb-3">
                                            <label for="name" class="form-label">
                                                Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">
                                                Email
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" class="form-control" id="email"  required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">
                                                Your rating:
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="rating-review">
                                                <input type="radio" id="sr-0-1" name="star-rating" value="5" />
                                                <label for="sr-0-1">★</label>
                                                <input type="radio" id="sr-0-2" name="star-rating" value="4" />
                                                <label for="sr-0-2">★</label>
                                                <input type="radio" id="sr-0-3" name="star-rating" value="3" />
                                                <label for="sr-0-3">★</label>
                                                <input type="radio" id="sr-0-4" name="star-rating" value="2" />
                                                <label for="sr-0-4">★</label>
                                                <input type="radio" id="sr-0-5" name="star-rating" value="1" />
                                                <label for="sr-0-5">★</label>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                                
                                    </form>
                                </div>
                            </div>
                                    
                        </div> 
                    </div> 
                </div>
            </div>
           
        </div>
    </div>
   
</x-layouts.app>