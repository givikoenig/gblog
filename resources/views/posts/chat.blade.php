@extends('layouts.posts')
@section('header')
    @include('posts.header')
@endsection
@section('content')
<div id="prop"></div>
<div id="example"></div>
<div id="mesg"></div>
<div id="vbind"></div>
<div id="vif"></div>
<div id="vfor"></div>
<div id="von"></div>
<div id="vmodel"></div>
<div id="vspinner"></div>
<div id="socket"></div>
<div class="container" id="chat">
    
    <!--<div class="row chatblock">-->
        <!--<div class="col-md-12">-->
            <!--<h5>Чат для неавторизованных</h5>-->
            <!--<socket-chat-component></socket-chat-component>-->
            <!--<daterange-picker-component></daterange-picker-component>-->
        <!--</div>-->
    <!--</div>-->
    @if (Auth::check())
    <div class="row">
        <div class="col-md-12 chatblock">
            <!--<h5>{{ Auth::user()->name }} - это я</h5>-->
<!--            <socket-private-component :users="{{ \App\User::select('name', 'email','id')->where([
                    ['id', '!=', Auth::id()],
                    ['confirmed', 1]
                ])->get()}}" :user="{{ Auth::user() }}"></socket-private-component>-->
            <socket-private-component :user="{{ Auth::user() }}"></socket-private-component>
        </div>
    </div>
    @endif
</div>

    
</div>
@endsection
@section('footer')
    @include('posts.footer')
@endsection