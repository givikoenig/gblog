@extends('layouts.posts')

{{-- @section('topbar')
	@include('posts.topbar')
@endsection --}}
@section('header')
	@include('posts.header')

<div style="margin-top: 100px; text-align: center;" >
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
             <script>setTimeout(function(){location.href="/"} , 5000);</script>
        </div>
    @endif
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        <script>setTimeout(function(){location = ''} , 5000);</script>
    @endif
</div>


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
<div id="chat"></div>
<div id="vplayer"></div>
<div id="app"></div>
	@include('posts.content')
@endsection

@section('footer')
	@include('posts.footer')
@endsection
