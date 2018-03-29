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
                <form id="login-form" name="login-form" class=" " action="{{ route('login') }}" method="post">
                    {{ csrf_field() }}

                    <div class="text-center">
                        <h3>ВХОД</h3>
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
                        <input type="password" id="password" name="password" value="" class="form-control " placeholder="Пароль" required>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-small btn-dark-solid full-width btn-rounded" type="submit">Вход</button>
                    </div>
                    <div class="login-social-link">
                        {{-- <a href="index.html" class="facebook">
                            Facebook
                        </a>
                        <a href="index.html" class="twitter">
                            Twitter
                        </a> --}}
                    </div>
                    <div class="form-group">
                        <input type="checkbox" value="remember-me" id="checkbox1">
                        <label for="checkbox1">Запомнить меня</label>
                        <a class="pull-right" data-toggle="modal" href="{{ route('password.request') }}"> Забыли пароль?</a>
                    </div>
                </form>
            </div>
            <div class="copyright-row text-center dark-txt">
                &copy; <a href="{{ route('home') }}" class="theme-color">{{ config('app.name') }}</a> {{ date(now()->format('Y')) }}</a>
            </div>
        </div>
    </div>
@endsection
