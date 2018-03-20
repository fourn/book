<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('users', 'UserController');
    $router->resource('books', 'BooksController');
    $router->resource('categories', 'CategoriesController');
    $router->resource('schools', 'SchoolsController');
    $router->resource('orders', 'OrdersController');
    $router->resource('transfers', 'TransfersController');
});
