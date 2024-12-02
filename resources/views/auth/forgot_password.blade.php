<x-layouts.auth  
    :title="__('Reset password')"
    :descriptions="''"
    :keywords="''">
    <div class="form-signin w-100 m-auto mt-3">
        <h1 class="fs-3 heading_auth">{{__('Reset password')}}</h1>
        <form method="POST" action="{{route('forgot-password.post')}}" id="form">
            @csrf

            <div class="form-group py-2 mt-3">
                <div class=" mb-2">
                    <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Email')}}</label>
                </div>
                <input type="text" name="email" data-require="true" class="form-control" data-max="256"  placeholder="{{__('Email')}}" >       
            </div>
            <div class="form_button py-2"> 
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-lg btn-block" type="submit"  type="button">{{__("Send")}}</button>
                </div>
            </div>
        </form>
    </div>

</x-layouts.app>