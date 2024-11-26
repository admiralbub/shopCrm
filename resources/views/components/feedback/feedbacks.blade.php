
 <div class="product_review-item ">
    <div class="product_review-item_img d-none d-lg-block">
        <img src="{{asset('images/img/no_photo.png')}}" alt="">  
    </div>
    <div class="product_review-item_content">
        <div class="product_review-item_head d-flex justify-content-between">
            <div class="product_review-item_username">
                {{$feedback->user_name}}
            </div>
            <div class="product_review-item_rating">
                <div class="product_review-item_rating-icon">
                    <div class="rating" data-rate-value="{{$feedback->rating}}"></div>
                </div>
            </div>
        </div>   
        <div class="product_review-item_body">
            <p>
                {{$feedback->comment}}
            </p>
        </div>
        <div class="product_review-item_footer">
            <i>{{$feedback->created_at}}</i>
         </div>
     </div>
     
</div>
@if($feedback->response)
    <div class="ml-3 py-3 product_review-response">
        <strong>{{__('Response')}}</strong>
        <p>{{$feedback->response}}</p>
    </div>
@endif
