<?php

use Illuminate\Support\Facades\Route;

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
Route::post('/login', 'Auth\LoginController@login')->name('login.submit');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register.form');
Route::post('/register', 'Auth\RegisterController@register')->name('register.submit');

Route::get('/', function () {
	if (!Auth::check())
		return view('user.login');
	if (Auth::user()->role_id == 1)
	{
		return \Redirect::route('admin.dashboard')->with('message', 'success!!!');
	}
	return \Redirect::route('user.dashboard')->with('message', 'success!!!');
})->name('index');

Route::get('/index', function () {
	if (!Auth::check())
		return view('user.login');
	if (Auth::user()->role_id == 1)
	{
		return \Redirect::route('admin.dashboard')->with('message', 'success!!!');
	}
	return \Redirect::route('user.dashboard')->with('message', 'success!!!');
})->name('index1');
// Admin Route

Route::prefix('/admin')->group(function () {
	Route::get('/', 'Admin\AdminController@root')->name('admin.dashboard');
	// Settings Section
	Route::prefix('/marketing')->group(function () {
		Route::get('/create', 'Admin\MarketingController@create')->name('admin.marketing.create');
		Route::post('/store', 'Admin\MarketingController@store')->name('admin.marketing.store');
		Route::get('/index', 'Admin\MarketingController@index')->name('admin.marketing.index');
        Route::get('/email/unsubscribe', 'Admin\MarketingController@fetchUnsubscribe')->withoutMiddleware(['auth:web'])->name('admin.marketing.email.fetchUnsubscribe');
        Route::get('/open-check', 'Admin\MarketingController@openCheck')->name('marketing.email.open.check')->withoutMiddleware(['auth:web']);
        Route::post('/unsubscribe', 'Admin\MarketingController@unsubscribe')->name('admin.marketing.email.unsubscribe')->withoutMiddleware(['auth:web']);

	});

    // warmup

    Route::prefix('/warmup')->group(function () {
		Route::get('/', 'Admin\WarmUpController@create')->name('admin.warmup');
		Route::post('/store', 'Admin\WarmUpController@store')->name('admin.warmup.save');
		Route::get('/run', 'Admin\WarmUpController@run')->name('admin.warmup.run');
	});


    //
    Route::prefix('/inbox')->group(function () {
		Route::get('/', 'Admin\InboxController@index')->name('admin.inbox');
        Route::post('/store', 'Admin\InboxController@store')->name('admin.marketing.email.unsubscribe')->withoutMiddleware(['auth:web']);

    });
	 //
	 Route::prefix('/unsubscriber')->group(function () {
		Route::get('/', 'Admin\UnSubscriberController@index')->name('admin.unsubscriber.list');
        Route::post('/delete', 'Admin\UnSubscriberController@delete')->name('admin.unsubscriber.delete')->withoutMiddleware(['auth:web']);

    });

});
// User Route
Route::prefix('/user')->group(function () {
	Route::get('/', 'UserController@root')->name('user.dashboard');
});
