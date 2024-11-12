<div class="banners mt-lg-4 mt-5">
    <div class="banner-slider">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <!-- Swiper -->
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
                </div>
            
            </div>
                   
        </div>
                
    </div>
</div>