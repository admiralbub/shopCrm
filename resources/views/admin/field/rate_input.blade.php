<label class="form-label">{{ $title }}</label>
<div class="rating-review">
    <input type="radio" id="sr-0-1" name="{{$attributes['name']}}" value="5" {{($attributes['haveRated'] ==5 ) ? 'checked' : ''}}/>
    <label for="sr-0-1">★</label>
    <input type="radio" id="sr-0-2" name="{{$attributes['name']}}" value="4" {{($attributes['haveRated'] ==4 ) ? 'checked' : ''}}/>
    <label for="sr-0-2">★</label>
    <input type="radio" id="sr-0-3" name="{{$attributes['name']}}" value="3" {{($attributes['haveRated'] ==3 ) ? 'checked' : ''}} />
    <label for="sr-0-3">★</label>
    <input type="radio" id="sr-0-4"   name="{{$attributes['name']}}" value="2" {{($attributes['haveRated'] ==2 ) ? 'checked' : ''}} />
    <label for="sr-0-4">★</label>
    <input type="radio" id="sr-0-5" name="{{$attributes['name']}}" value="1" {{($attributes['haveRated'] ==1 ) ? 'checked' : ''}}  />
    <label for="sr-0-5">★</label>
</div>