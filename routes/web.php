<?php

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
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
Route::get('/register/{role_id?}', 'Auth\RegisterController@showRegistrationForm')->name('register.form');
Route::post('/register', 'Auth\RegisterController@register')->name('register.submit');

Route::get('/', function () {
	if (!Auth::check())
	{
		return view('user.login')->with(['role_id'=> Role::RESIDENT_ROLE]);
	}
	
	if (Auth::user()->role_id == Role::ADMIN_ROLE)
	{
		return redirect('/admin')->with('message', 'success!!!');
	}
	if(Auth::user()->role_id  == Role::RESIDENT_ROLE)
	{
		return \Redirect::route('user.dashboard')->with('message', 'success!!!');
	}
	else if(Auth::user()->role_id  == Role::BUSINESS_ROLE)
	{
		return \Redirect::route('business.dashboard')->with('message', 'success!!!');
	}
	else if(Auth::user()->role_id  == Role::STAFF_ROLE)
	{
		return \Redirect::route('staff.dashboard')->with('message', 'success!!!');
	}
})->name('index');

Route::get('/business', function () {
	
	if (!Auth::check())
	{
		return view('user.login')->with(['role_id'=>Role::BUSINESS_ROLE]);
	}
	if (Auth::user()->role_id == 1)
	{
		return redirect('/admin')->with('message', 'success!!!');
	}
	return \Redirect::route('business.dashboard')->with('message', 'success!!!');

})->name('index');
Route::get('/staff', function () {
	
	if (!Auth::check())
	{
		return view('user.login')->with(['role_id'=>Role::STAFF_ROLE]);
	}
	if (Auth::user()->role_id == 1)
	{
		return redirect('/admin')->with('message', 'success!!!');
	}
	return \Redirect::route('staff.dashboard')->with('message', 'success!!!');

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

Route::prefix('/admin-own')->group(function () {
	Route::get('/', 'Admin\AdminController@root')->name('admin.dashboard');
	// Settings Section
	

});
// User Route
Route::prefix('/resident-dashboard')->group(function () {
	Route::get('/', 'UserController@root')->name('user.dashboard');
});
Route::prefix('/business-dashboard')->group(function () {
	Route::get('/', 'BusinessController@root')->name('business.dashboard');
	Route::get('/register', 'BusinessController@register')->name('business.register');
	Route::post('/register', 'BusinessController@submitRegister')->name('business.register');
	Route::get('/users', 'BusinessController@users')->name('business.user.list');
});
Route::prefix('/staff-dashboard')->group(function () {
	Route::get('/', 'StaffController@root')->name('staff.dashboard');
	Route::get('/register', 'StaffController@register')->name('staff.register');
	Route::post('/register', 'StaffController@submitRegister')->name('staff.register');
	Route::get('/users', 'StaffController@users')->name('staff.user.list');
});