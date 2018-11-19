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
<div class="container" id="ipcalc">
    <div class="srow">
        <div class="col-md-12 ipcalcblock card card-default">
            <div class="card-header">
                <h3>IPv4 network calculator</h3>
            </div>
            <div class="card-body">
                <ipcalc-component></ipcalc-component>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
    @include('posts.footer')
@endsection
