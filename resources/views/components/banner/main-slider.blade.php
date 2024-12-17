
@if(count($sliders)>0)    
    <div class="swiper main_banner">
        <div class="swiper-wrapper main_banner-wrapper">
            @foreach ($sliders as $slider)
                <div class=" main_banner-wrapper-slide swiper-slide">
                    @if($slider->url)
                        <a href="{{$slider->url}}">
                            <img src="{{ asset($slider->img) }}">
                        </a>
                    @else
                        <img src="{{ asset($slider->img) }}">
                    @endif
                </div>
            @endforeach
        </div>
        <div class="main_banner-pagination"></div>
    </div>
@endif
