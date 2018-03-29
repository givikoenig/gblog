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
	@include('posts.content')
@endsection

@section('footer')
	@include('posts.footer')
@endsection
