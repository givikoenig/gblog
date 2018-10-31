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
	<div id="socket">
		<br><br><br><br><br><br>
		<div class="container my-5">
			<div class="row justify-content-sm-center">
                            <socket-component></socket-component>
			</div>
		</div>
                <br><br><br><br><br><br>
	</div>
@endsection
@section('footer')
    @include('posts.footer')
@endsection

