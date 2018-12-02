@extends('layouts.posts')
@section('header')
@include('posts.header')
@endsection
@section('content')
<div id="vplayer">
<!--    <div class="row">
        <div class="col-md-8 col-md-push-2" style="margin: 0 auto 10rem auto;">
            <vplayer-component></vplayer-component>
        </div>
    </div>-->
    <div class="row">
        <div class="col-md-8 col-md-push-2"  style="margin: 10rem auto;">
            <vplayer2-component></vplayer2-component>
        </div>
    </div>
</div>


@endsection
@section('footer')
        @include('posts.footer')
@endsection


