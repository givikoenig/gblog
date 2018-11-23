@extends('layouts.posts')
@section('content')
    <div class="login login-bg">
        <div class="container">
            <div class="login-logo text-center">
                <a href="{{ route('home') }}">
                    <img class="retina" src="{{ asset('assets') }}/img/logo.png" alt="" />
                </a>
            </div>
            <div class="login-box btn-rounded login-bg-input border-less-input">
                <form id="login-form" name="login-form" class="" action="{{ route('register') }}" method="post">
                    {{ csrf_field() }}

                    <div class="text-center">
                        <h3>РЕГИСТРАЦИЯ</h3>
                    </div>
                    <input class="text" name="honey_pot" style="display: none">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Имя пользователя">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="E-Mail">
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
                    <div class="form-group">
                        <input type="password" id="password-confirm" name="password_confirmation" value="" class="form-control " placeholder="Подтвердите пароль…" required>
                    </div>

                    <div class="form-group">
                        {!! NoCaptcha::display() !!}
                        <button class="btn btn-small btn-dark-solid full-width btn-rounded" id="register-form-submit" type="submit">Регистрация</button>
                    </div>
                </form>
            </div>
            <div class="copyright-row text-center dark-txt">
                &copy; <a href="{{ route('home') }}" class="theme-color">{{ config('app.name') }}</a> {{ date(now()->format('Y')) }}
            </div>
        </div>
    </div>
@endsection
