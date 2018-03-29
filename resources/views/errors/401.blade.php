@extends('layouts.posts')
@section('header')
    @include('posts.header')
@endsection
@section('content')
<section class="body-content ">

            <!--error-->
            <div class="page-content">
                <div class="container">
                    <div class="row page-content">
                        <div class="col-md-5 text-center">
                            <div class="error-avatar">
                                <img src="{{ asset('assets') }}/img/error-avatar.png" alt="" />
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="error-info">
                                <div class="error404">
                                    401
                                </div>
                                <div class="error-txt">
                                    Доступ запрещен!
                                </div>
                                <a href="{{ route('home') }}" class="btn btn-medium  btn-theme-color "> Пошли домой…</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--error-->

        </section>
@endsection
@section('footer')
    @include('posts.footer')
@endsection