<x-layouts.auth  
    :title="__('Entrance to the personal office')"
    :descriptions="''"
    :keywords="''">

    <div class="form-signin w-100 m-auto">
        <div class="py-3">
            <h1 class="heading_auth  fs-3">{{__("Entrance to the personal office")}}</h1>
            <p class="pt-2 heading_title">{{__('title_register')}}</p>
            @if(Session::has('error'))
                <x-alert.alert status="danger">
                    {{ Session::get('error') }}    
                </x-alert.alert>
            @endif
            <form method="POST" action="{{route('auth.enter')}}" id="form">
                @csrf
                <div class="form-group py-2">
                    <div class=" mb-2">
                        <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Email')}}</label>
                    </div>
                    <input type="text" name="email" data-require="true" class="form-control" data-max="256"  placeholder="{{__('Email')}}" >       
                 </div>
                <div class="form-group py-2">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Password')}}</label>
                        <a href="/forgot-password" class="fs-6"> {{__('Reset password')}}? </a>
                    </div>
                    <input type="password" data-require="true" data-min="6" class="form-control" name="password" placeholder="{{__('Password')}}" >
                </div>
                <div class="form_button py-2"> 
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-lg btn-block" type="submit"  type="button">{{__("Enter")}}</button>
                    </div>
                </div>
                <div class="social_auth py-2  d-none">
                    <div class="social_link">
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-facebook btn-user btn-block facebook_link" rel="nofollow">
                                <i class="fab fa-facebook-f fa-fw"></i>
                                {{__('enter_facebook')}}
                            </a>
                            <a href="#" class="btn btn-facebook btn-user btn-block google_link" rel="nofollow">
                                <i class="fab fa-google-plus-g"></i>
                                {{__('enter_google')}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-3 fs-6">
                    {!!__('dont_account_title',['route'=>route('register')])!!} 
                </div>
            </form>
        </div>
    </div>
    
    
</x-layouts.app>