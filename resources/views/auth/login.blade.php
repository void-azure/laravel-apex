@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card primary-border">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        <fieldset>
                            <legend>{{ __('misc.login') }}</legend>
                            @csrf
                            <div class="form-group">
                                <label for="username">{{ __('misc.username') }}</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="{{ __('misc.username') }}" autocomplete="current-username" autofocus />
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('misc.password') }}</label>
                                <input type="password" name="password" class="form-control" id="password" aria-describedby="passwordHelp" autocomplete="current-password" placeholder="{{ __('misc.password') }}" />
                                @if (Route::has('password.request'))
                                <small id="passwordHelp" class="form-text text-muted">{{ __('misc.forgotten_password') }} <a href="{{ route('password.request') }}">{{ __('misc.click_me') }}</a></small>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">{{ __('misc.remember_me') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">{{ __('misc.login') }}</button>
                            </div>
                            <hr>
                            <center><p>{{ __('misc.if_you_dont_have_an_account') }}, <a href="{{ route('register') }}">{{ __('misc.click_me') }}</a><p></center>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
