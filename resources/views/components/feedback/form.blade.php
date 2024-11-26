<div class="reviews-tab-form px-4">
    <h3>{{__('Add your review')}}</h3>
   
    <form class="mt-3" id="form" method="POST" action="{{route('feedback.post',['id'=>$id])}}">
        @csrf
        <div class="mb-3">
            <label for="message" class="form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">
                {{__('Feedback')}}
                <span class="text-danger">*</span>
            </label>
            <textarea class="form-control" id="message" name="comment" rows="4"></textarea>
        </div>
                                            
        <div class="mb-3">
            <label for="name" class="form-label form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">
                {{__('firstName_title')}}
                <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" value="{{auth()->check() ? auth()->user()->first_name : '' }}" id="name" name="name" data-require="true" data-max="256">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">
                {{__('Email')}}
                <span class="text-danger">*</span>
            </label>
            <input type="email" class="form-control" id="email" name="email" value="{{auth()->check() ? auth()->user()->email : '' }}"  data-require="true" data-max="256 ">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">
                {{__('Grade')}}:
                <span class="text-danger">*</span>
            </label>
            <div class="rating-review">
                <input type="radio" id="sr-0-1" name="rating" value="5" />
                <label for="sr-0-1">★</label>
                <input type="radio" id="sr-0-2" name="rating" value="4" />
                <label for="sr-0-2">★</label>
                <input type="radio" id="sr-0-3" name="rating" value="3" />
                <label for="sr-0-3">★</label>
                <input type="radio" id="sr-0-4" name="rating" value="2" />
                <label for="sr-0-4">★</label>
                <input type="radio" id="sr-0-5" name="rating" value="1" />
                <label for="sr-0-5">★</label>
            </div>
        </div>
        <input type="text" class="form-control" name="slug" value="{{$slug}}" hidden>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
        </div>
    </form>
</div>