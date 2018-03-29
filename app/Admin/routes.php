<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('site/users', UserController::class);
    $router->post('site/posts/{post}/remove', 'PostController@remove')->name('posts.remove');
    $router->post('site/users/{user}/remove', 'UserController@remove')->name('users.remove');
    $router->resource('site/posts', PostController::class);
    $router->resource('site/tags', TagController::class);
    $router->resource('site/about', AboutController::class);

});
