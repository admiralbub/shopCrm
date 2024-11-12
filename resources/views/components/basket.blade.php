<div class="cartmini__area">
    <div class="cartmini__area-wrapper">
        <div class="cartmini__area-title">
            <span class="fs-5 fw-bold">{{__('Basket')}}</span>
        </div>
        <div class="cartmini__close" title="Close">
            <button type="button" class="cartmini__close-btn cartmini-close-btn" title="Close" id="closeRightBasket">
                <svg class="icon  svg-icon-ti-ti-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M18 6l-12 12"></path>
                    <path d="M6 6l12 12"></path>
                </svg>                
            </button>
        </div>
        <div class="cartmini__area-widget">
            <div class="cartmini__area-items" id="basketNavbar">
                
              
            </div>
        </div>
        
        <div class="cartmini__area-wrapper_checkout">
            <div class="d-flex flex-column gap-2">
                <div class="pb-3">
                    <h4>{{__('Conclusion')}}</h4>
                    <span id="totalbBasket">0</span>
                </div>
               
                
                
            </div>
        </div>
        <div class="cartmini__area-wrapper_buttons">
            <div class="d-grid gap-2">
                <a href="{{route('order.index')}}" type="button" class="btn btn-primary py-3 fw-bold">{{__('Continue shopping')}}</a>
                
            </div>
        </div>
    </div>
    
</div>