<x-layouts.app  
    :title="__('Account')"
    :descriptions="__('Account')"
    :keywords="__('Account')">

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
                    <h1 class="fs-4">{{__('Account')}}</h1>    
                </div>
                
                
                
                <form class="mt-3 account_panel" method="POST" action="{{route('profile.edit')}}" id="form">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('firstName_title')}}</label>
                            <input type="text" class="form-control  mt-2"  data-require="true" data-max="256" name="first_name" value="{{auth()->user()->first_name}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('lastName_title')}}</label>
                            <input type="text" class="form-control  mt-2"  data-require="true" data-max="256" name="last_name" value="{{auth()->user()->last_name}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('MiddleName_title')}}</label>
                            <input type="text" class="form-control  mt-2"  name="middle_name"  value="{{auth()->user()->middle_name}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Email')}}</label>
                            <input type="text" class="form-control  mt-2"  data-require="true" data-max="256" name="email" value="{{auth()->user()->email}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Phone_title')}}</label>
                            <input type="tel" class="form-control mt-2 tel" id="phone"  name="phone" data-require="true"  value="{{auth()->user()->phone}}">
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
