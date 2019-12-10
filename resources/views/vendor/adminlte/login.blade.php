@extends('adminlte::master')

@section('metas')
    <meta name="google-signin-client_id" content="{{ env('GOOGLE_CLIENT_ID') }}.apps.googleusercontent.com">
@endsection

@section('adminlte_css')
    {{--    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">--}}
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link rel="stylesheet" href="{{ asset(mix('web/assets/css/styles.css')) }}">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>
            <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post" id="login_form">
                {{ csrf_field() }}

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                        placeholder="{{ trans('adminlte::adminlte.email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                        placeholder="{{ trans('adminlte::adminlte.password') }}">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                @if ($errors->has('g-recaptcha-response'))
                    <div>
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                    </div>
                @endif
                <div class="row">
                    <div class="col-sm-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">{{ trans('adminlte::adminlte.remember_me') }}</label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ trans('adminlte::adminlte.sign_in') }}
                        </button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 mb-2">
                        <a href="{{ route('login.provider', 'google') }}" class="btn btn-light w-100">
                            <i class="mdi mdi-google"></i>
                            {{ __('Sign in with Google') }}
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="{{ route('login.provider', 'facebook') }}" class="btn btn-light w-100">
                            <i class="mdi mdi-facebook-box"></i>
                            {{ __('Sign in with Facebook') }}
                        </a>
                    </div>
                </div>
                {!!  GoogleReCaptchaV3::renderField('captcha_login_form','login') !!}
            </form>

            <br>
            <p>
                <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}" class="text-center">
                    {{ trans('adminlte::adminlte.i_forgot_my_password') }}
                </a>
            </p>
            @if (config('adminlte.register_url', 'register'))
                <p class="mb-0">
                    <a href="{{ url(config('adminlte.register_url', 'register')) }}" class="text-center">
                        {{ trans('adminlte::adminlte.register_a_new_membership') }}
                    </a>
                </p>
            @endif
        </div>
        <div style="margin-top: 5px; font-size: .8rem">
            Este site é protegido por Google reCaptcha e suas
            <a href="https://policies.google.com/privacy" target="_blank">Políticas de privacidade</a>
            e
            <a href="https://policies.google.com/terms" target="_blank">Termos de uso</a>
            são aplicáveis.
        </div>
    </div><!-- /.login-box -->
@stop

@section('adminlte_js')
    @yield('js')
@stop
