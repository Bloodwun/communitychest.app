<?php

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UsernameController;
use App\Http\Controllers\PromotionalPdfController;

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


// Forgot Username route
Route::get('/username/request', [UsernameController::class, 'showUsernameRequestForm'])->name('username.request');
Route::post('/username/email', [UsernameController::class, 'sendUsernameEmail'])->name('username.email');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}/{email}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

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
	} else if(Auth::user()->role_id  == Role::OWNER_ROLE)
	{
		return \Redirect::route('owner.dashboard')->with('message', 'success!!!');
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
Route::get('/owner', function () {
	
	if (!Auth::check())
	{
		return view('user.login')->with(['role_id'=>Role::STAFF_ROLE]);
	}
	if (Auth::user()->role_id == 1)
	{
		return redirect('/admin')->with('message', 'success!!!');
	}
	return \Redirect::route('owner.dashboard')->with('message', 'success!!!');

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
	Route::get('/promotional-pdfs', 'PromotionalPdfController@index')->name('promotional.index');


});
Route::prefix('/business-dashboard')->group(function () {
	Route::get('/', 'BusinessController@root')->name('business.dashboard');
	Route::get('/register', 'BusinessController@register')->name('business.register');
	Route::post('/register', 'BusinessController@submitRegister')->name('business.register');
	Route::get('/users', 'BusinessController@users')->name('business.user.list');

	Route::get('/promotional-pdfs/create', 'PromotionalPdfController@create')->name('promotional.create');
	Route::post('/promotional-pdfs/store', 'PromotionalPdfController@store')->name('promotional.store');
	Route::post('/promotional-pdfs/edit', 'PromotionalPdfController@edit')->name('promotional.edit');
	Route::post('/promotional-pdfs/update', 'PromotionalPdfController@update')->name('promotional.update');
	Route::post('/promotional-pdfs/destroy', 'PromotionalPdfController@destroy')->name('promotional.destroy');
});
Route::prefix('/staff-dashboard')->group(function () {
	Route::get('/', 'StaffController@root')->name('staff.dashboard');
	Route::get('/register', 'StaffController@register')->name('staff.register');
	Route::post('/register', 'StaffController@submitRegister')->name('staff.register');
	Route::get('/users', 'StaffController@users')->name('staff.user.list');
});
Route::prefix('/owner-dashboard')->group(function () {
    // Dashboard route
    Route::get('/', 'OwnerController@root')->name('owner.dashboard');

    // View all users
    Route::get('/allusers', 'OwnerController@alluser')->name('owner.all.user');

    // Register routes
    Route::get('/register', 'OwnerController@register')->name('owner.register');
    Route::post('/register', 'OwnerController@submitRegister')->name('owner.register.submit');

    // CRUD Routes for Users
    Route::get('/users', 'OwnerController@users')->name('owner.user.list'); // List users
    Route::get('/users/create', 'OwnerController@create')->name('owner.user.create'); // Show create form
    Route::post('/users', 'OwnerController@store')->name('owner.user.store'); // Handle create form submission
    Route::get('/users/{id}/edit', 'OwnerController@edit')->name('owner.user.edit'); // Show edit form
    Route::put('/users/{id}', 'OwnerController@update')->name('owner.user.update'); // Handle update form submission
    Route::delete('/users/{id}', 'OwnerController@destroy')->name('owner.user.destroy'); // Handle user deletion
});

