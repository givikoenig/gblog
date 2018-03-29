@extends('layouts.posts')
@section('content')
    <div class="login login-bg">

        <div class="container">
            <div class="login-logo text-center">
                <a href="{{ route('home') }}">
                    <img class="retina" src="assets/img/logo.png" alt="" />
                </a>
            </div>
            <div class="login-box btn-rounded login-bg-input border-less-input">
                <form  class=" " action="{{ route('password.request') }}" method="post">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="text-center">
                        <h3>СМЕНА ПАРОЛЯ</h3>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" id="email" name="email" value="{{ $email or old('email') }}" class="form-control" placeholder="E-Mail">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" id="password" name="password" value="" class="form-control " placeholder="Пароль…" required>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input type="password" id="password-confirm" name="password_confirmation" value="" class="form-control " placeholder="Подтвердите пароль…" required>
                        @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-small btn-dark-solid full-width btn-rounded" type="submit">Сменить пароль</button>
                    </div>
                </form>
            </div>
            <div class="copyright-row text-center dark-txt">
                &copy; <a href="{{ route('home') }}" class="theme-color">{{ config('app.name') }}</a> {{ date(now()->format('Y')) }}</a>
            </div>
        </div>
    </div>
@endsection
