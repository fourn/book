<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index')->name('index');
Route::get('memberIndex', 'IndexController@memberIndex')->name('memberIndex');
Route::get('setSchool/{id}', 'IndexController@setSchool')->name('setSchool');
Route::get('search', 'IndexController@search')->name('search');

//登录注册
Route::get('register', 'PassportController@showRegisterForm')->name('passport.register');
Route::post('register', 'PassportController@register')->name('passport.register');
Route::get('login', 'PassportController@showLoginForm')->name('passport.login');
Route::post('login', 'PassportController@login')->name('passport.login');
Route::get('logout', 'PassportController@logout')->name('passport.logout');
Route::get('forgot', 'PassportController@showForgotForm')->name('passport.forgot');
Route::post('forgot', 'PassportController@forgot')->name('passport.forgot');

//个人信息
Route::get('user', 'UserController@index')->name('user.index');
Route::prefix('user')->group(function (){
    Route::get('avatar', 'UserController@avatar')->name('user.avatar');
    Route::post('avatar', 'UserController@updateAvatar')->name('user.avatar');
    Route::get('name', 'UserController@name')->name('user.name');
    Route::post('name', 'UserController@updateName')->name('user.name');
    Route::post('gander', 'UserController@updateGender')->name('user.gender');
    Route::post('school', 'USerController@updateSchool')->name('user.school');
});

//书本
Route::get('books/list', 'BooksController@list')->name('books.list');
Route::get('books/my', 'BooksController@my')->name('books.my');
Route::post('upload_image', 'BooksController@uploadImage')->name('books.upload_image');
Route::get('books/show-self/{book}', 'BooksController@showSelf')->name('books.show_self');//注意此处是一个隐式绑定
Route::get('books/toggle_show', 'BooksController@toggleShow')->name('books.toggle_show');
Route::resource('books', 'BooksController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
//前端图片裁剪
Route::get('photo_clip', 'BooksController@photo_clip')->name('photo_clip');

//订单
Route::prefix('order')->group(function (){
    Route::get('create/{book}', 'OrdersController@create')->name('order.create');
    Route::post('store', 'OrdersController@store')->name('order.store');
    //列表
    Route::get('index', 'OrdersController@index')->name('order.index');
    Route::get('seller/index', 'OrdersController@sellerIndex')->name('order.seller_index');
    //详情
    Route::get('show/{order}', 'OrdersController@show')->name('order.show');
    Route::get('seller/show/{order}', 'OrdersController@sellerShow')->name('order.seller_show');
    //操作
    Route::get('pay/{order}' ,'OrdersController@pay')->name('order.pay');//发起支付
    Route::any('notify')->name('order.notify');
    Route::get('fake_pay', 'OrdersController@fakePay')->name('order.fake_pay');//模拟支付成功
    Route::get('confirm/{order}', 'OrdersController@confirm')->name('order.confirm');//卖家确认
    Route::get('send/{order}', 'OrdersController@send')->name('order.send');//卖家送达
    Route::get('get/{order}', 'OrdersController@get')->name('order.get');//买家取书
    Route::get('cancel/{order}', 'OrdersController@cancel')->name('order.cancel');//买家取消
});

//消息
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

//提现
Route::resource('transfers', 'TransfersController', ['only' => ['create', 'store']]);

//资金
Route::get('account', 'AccountsController@index')->name('account.index');
Route::get('account/logs', 'AccountsController@logs')->name('account.logs');

//文章
Route::get('article/{article}/show', 'ArticlesController@show')->name('article.show');