<div class="modal fade" id="onclick" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title fs-5" id="exampleModalLabel">{{__('Buy in 1 click')}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="fs-6">{!! __('Enter your phone number and we will call you back') !!}</p>
                <form id="form" method="POST" action="{{route('oneclick.post',['id'=>$product->id])}}">
                    @csrf
                    <div class="mb-1">
                        <input type="text" class="form-control tel" value="{{auth()->check() ? auth()->user()->phone : '' }}" id="phone" name="phone" data-require="true">
                    </div>
                    <input type="text" class="form-control" name="slug" value="{{$product->slug}}" hidden>
                    <input type="hidden" id="quantity-input" name="quantity" value="1">
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>