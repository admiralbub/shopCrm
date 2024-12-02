<x-layouts.auth  
    :title="__('Entrance to the personal office')"
    :descriptions="''"
    :keywords="''">


    <form method="POST" action="{{route('reset.password.post',['token'=>$token])}}" id="form">
        @csrf

        <div class="form-group py-2 mt-3">
            <div class=" mb-2">
                <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('New password')}}</label>
            </div>
            <input type="password" class="form-control  mt-2" id="password" name="password" data-require="true">
        </div>
        <div class="form-group py-2 mt-3">
            <div class=" mb-2">
                <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Confirm new password')}}</label>
            </div>
            <input type="password" class="form-control  mt-2" name="password_confirmation" data-require="true">
        </div>
        <div class="form_button py-2"> 
            <div class="d-grid gap-2">
                <button class="btn btn-primary btn-lg btn-block" type="submit"  type="button">{{__("Send")}}</button>
            </div>
        </div>
    </form>
</x-layouts.app>