<x-layouts.app  
    :title="__('Change password')"
    :descriptions="__('Change password')"
    :keywords="__('Change password')">

    <div class="account container py-5">
        <div class="row">
            <div class="col-lg-3">
                <x-cabinet.menu/>
            </div>
            <div class="col-lg-9 ">
                @if ($errors->any())
                     
                     <x-alert.alert status="danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        
                    </x-alert.alert>
                @endif
                @if(Session::has('success'))
                    <x-alert.alert status="success">
                        {{ Session::get('success') }}    
                    </x-alert.alert>
                @endif
                <div class="account_heading">
                    <h1 class="fs-4">{{__('Change password')}}</h1>    
                </div>
                
                
                
                <form class="mt-3 account_panel" method="POST" action="{{route('change_password.update')}}" id="form">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('New password')}}</label>
                            <input type="password" class="form-control  mt-2" id="password" name="password" data-require="true">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Confirm new password')}}</label>
                            <input type="password" class="form-control  mt-2" name="password_confirmation" data-require="true">
                        </div>
                        
                        <div class="col-12  mt-3" >
                            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</x-layouts.app>