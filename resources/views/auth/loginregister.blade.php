@extends('layouts.posts')


<section class="body-content ">


            <div class="page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">


                            <section class="normal-tabs line-tab">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#tab-login">Login</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#tab-register">register</a>
                                    </li>

                                </ul>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div id="tab-login" class="tab-pane active">
                                            <div class="login register ">
                                                <div class=" btn-rounded">
                                                    <form class=" " action="#" method="post">

                                                        <div class="form-group">
                                                            <input type="text" name="login-form-username" value="" class="form-control" placeholder="Login ID">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="password" name="login-form-password" value="" class="form-control " placeholder="Password">
                                                        </div>

                                                        <div class="form-group">
                                                            <button class="btn btn-small btn-dark-solid full-width" value="login">Login
                                                            </button>
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="checkbox" value="remember-me" id="checkbox1">
                                                            <label for="checkbox1">Remember me</label>
                                                            <a class="pull-right" data-toggle="modal" href="#forgotPass"> Forgot Password?</a>
                                                        </div>

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                        <div id="tab-register" class="tab-pane">
                                            <form class=" login" action="#" method="post">

                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Name">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Email">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="User Name">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Phone">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" placeholder="Choose Password">
                                                </div>

                                                <div class="form-group">
                                                    <input type="password" class="form-control" placeholder="Confirm Password">
                                                </div>

                                                <div class="form-group">
                                                    <button class="btn btn-small btn-dark-solid full-width " id="login-form-submit" name="login-form-submit" value="login">Register
                                                    </button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>

            </div>


        </section>