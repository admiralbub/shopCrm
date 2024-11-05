<x-layouts.auth  
    :title="__('register')"
    :descriptions="''"
    :keywords="''">


    <div class="form-signin w-100 m-auto mt-3">
        <h1 class="fs-3 heading_auth">{{__('register')}}</h1>
        <p class="pt-2 heading_title">{{__('register_description')}}</p>
        @if(Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        <form class="mt-4" action="{{route('register.get')}}" method="POST" id="form">
            @csrf
            <div class="mb-3">
                <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('firstName_title')}}</label>
                <input type="text" class="form-control" id="firstName" name="first_name" data-require="true" data-max="256">
                @if ($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('lastName_title')}}</label>
                <input type="text" class="form-control" id="lastName" name="last_name" data-require="true" data-max="256">
                @if ($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('MiddleName_title')}}</label>

                <input type="text" class="form-control" id="middleName" name="middle_name">
                @if ($errors->has('middle_name'))
                    <span class="text-danger">{{ $errors->first('middle_name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Email')}}</label>

                <input type="email" class="form-control" id="email"  name="email" data-require="true" data-max="256">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Phone_title')}}</label>

                <input type="tel" class="form-control tel" id="phone" name="phone"  data-require="true">
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Password')}}</label>

                <input type="password" class="form-control" id="password" name="password"  data-require="true">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label class="font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Repeatpassword')}}</label>

                <input type="password" class="form-control"  name="password_confirmation"  data-require="true">
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg btn-block">{{__('register_button')}}</button>
            </div>
            
        </form>
    </div>
</x-layouts.app>