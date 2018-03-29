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
                <form  action="{{ route('password.email') }}" method="post">
                    {{ csrf_field() }}
                    <div class="text-center">
                        <h3>ИЗМЕНЕНИЕ ПАРОЛЯ</h3>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="E-Mail">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-small btn-dark-solid full-width btn-rounded" type="submit">Отправить ссылку для изменения пароля</button>
                    </div>
                </form>
            </div>
            <div class="copyright-row text-center dark-txt">
                &copy; <a href="{{ route('home') }}" class="theme-color">{{ config('app.name') }}</a> {{ date(now()->format('Y')) }}</a>
            </div>
        </div>
    </div>
@endsection
