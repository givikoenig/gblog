@extends('layouts.posts')
@section('header')
@include('posts.header')
@endsection
@section('content')
<div id="vplayer">
    <div class="row">
        <div class="col-md-8 col-md-push-2"  style="margin: 6rem auto;">
            <vplayer-component></vplayer-component>
        </div>
    </div>
</div>
@endsection
@section('footer')
        @include('posts.footer')
@endsection


