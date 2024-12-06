<?php

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\Auth\UsernameController;
use App\Http\Controllers\PromotionalPdfController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
/*

|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is wher
e you can register web routes for your application. These
| routes are loadddded by the RouteServiceProvider within a group which
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
		return view('user.login')->with(['role_id'=>Role::BUSINESS_ROLE]);
	}else{
		
		if(Auth::user()->role_id == 1){
			return \Redirect::route('owner.dashboard')->with('message', 'success!!!');
		}elseif(Auth::user()->role_id == 2){
			return \Redirect::route('admin.dashboard')->with('message', 'success!!!');
		}elseif(Auth::user()->role_id == 3){
			return \Redirect::route('business.dashboard')->with('message', 'success!!!');
		}elseif(Auth::user()->role_id == 4){
			return \Redirect::route('business.dashboard')->with('message', 'success!!!');
		}elseif(Auth::user()->role_id == 5){
			return \Redirect::route('admin.dashboard')->with('message', 'success!!!');
		}elseif(Auth::user()->role_id == 6){
		    return \Redirect::route('prop_manager.dashboard')->with('message', 'success!!!');
		}elseif(Auth::user()->role_id == 7){
		    return \Redirect::route('admin.dashboard')->with('message', 'success!!!');
		}elseif(Auth::user()->role_id == 8){
		    return \Redirect::route('admin.dashboard')->with('message', 'success!!!');
		}
		
	}
})->name('index');






// Owner Route
Route::prefix('/owner-dashboard')->middleware('role:' . \App\Models\Role::OWNER_ROLE)->name('owner.')->group(function () {
    Route::get('/', 'OwnerController@root')->name('dashboard');
    Route::resource('admin-roles', AdminRoleController::class);
    Route::get('/all-role', [AdminRoleController::class, 'index'])->name('all.role');
    Route::post('/all-role/store', [AdminRoleController::class, 'store'])->name('roles.store');
    Route::get('/all-roles/{id}/edit', [AdminRoleController::class, 'edit'])->name('roles.edit');
    Route::put('/all-roles/{id}', [AdminRoleController::class, 'update'])->name('roles.update');
    Route::delete('/all-role/destroy/{id}', [AdminRoleController::class, 'destroy'])->name('roles.destroy');

    Route::get('/user/create', [UserController::class, 'user_create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/admin/{id}/edit', [UserController::class, 'edit'])->name('admin.edit');
    Route::get('/all-admin', [UserController::class, 'all_admin'])->name('all.admin');
    Route::get('/all-cummiunitystaff', [UserController::class, 'all_cummiunitystaff'])->name('all.cummiunitystaff');
    Route::get('/all-business', [UserController::class, 'all_business'])->name('all.business');
    Route::get('/all-business-staff', [UserController::class, 'all_business_staff'])->name('all.business.staff');
    Route::get('/all-property-manager', [UserController::class, 'all_property_manager'])->name('all.property.manager');
    Route::get('/all-property-staff', [UserController::class, 'all_property_staff'])->name('all.property.staff');
    Route::get('/all-resident', [UserController::class, 'all_resident'])->name('all.resident');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
     // Route::resource('products', ProductController::class);
     Route::get('products', [ProductController::class, 'index'])->name('products.index');
     Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
     Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
     Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
     Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
     Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
     Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});



// Admin Route
Route::prefix('/admin-dashboard')->middleware('role:' . \App\Models\Role::ADMIN_ROLE)->name('admin.')->group(function () {
	Route::get('/', [UserController::class, 'root'])->name('dashboard');

	Route::get('/all-cummiunitystaff', [UserController::class, 'all_cummiunitystaff'])->name('all.cummiunitystaff');
    Route::get('/promotional-pdfs', 'PromotionalPdfController@index')->name('promotional.index');
    Route::get('/new-user', [UserController::class, 'user_create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
	Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
	Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});



// Business Route
Route::prefix('/business-dashboard')->middleware('role:' . \App\Models\Role::BUSINESS_ROLE)->name('business.')->group(function () {
    Route::get('/', 'BusinessController@root')->name('dashboard');
    Route::get('/users', 'BusinessController@users')->name('user.list');
	Route::get('/new-user', [UserController::class, 'user_create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
	Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/all-business-staff', [UserController::class, 'all_business_staff'])->name('all.business.staff');
	Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/promotional-pdfs/create', 'PromotionalPdfController@create')->name('promotional.create');
    Route::post('/promotional-pdfs/store', 'PromotionalPdfController@store')->name('promotional.store');
    Route::post('/promotional-pdfs/edit', 'PromotionalPdfController@edit')->name('promotional.edit');
    Route::post('/promotional-pdfs/update', 'PromotionalPdfController@update')->name('promotional.update');
    Route::post('/promotional-pdfs/destroy', 'PromotionalPdfController@destroy')->name('promotional.destroy');
    // Route::resource('products', ProductController::class);
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('product/list', [ProductController::class, 'list'])->name('products.list');
    Route::get('order/list', [ProductController::class, 'order_list'])->name('myorder.list');

    Route::get('buy-product/{product}', [ProductController::class, 'buyProduct'])->name('products.buy');
    Route::post('create-order/{product}', [ProductController::class, 'createOrder'])->name('products.createOrder');
    Route::get('/confirm-payment', [ProductController::class, 'confirmPayment'])->name('products.confirm');

    Route::get('payment-success', [ProductController::class, 'paymentSuccess'])->name('products.success');
    Route::get('payment-cancel', [ProductController::class, 'paymentCancel'])->name('products.cancel');
    


});

// property-manager Route
Route::prefix('property-manager-dashboard')->middleware('role:' . \App\Models\Role::PROPERTY_MANAGER_ROLE)->name('prop_manager.')->group(function () {
    Route::get('/', 'BusinessController@root')->name('dashboard');

	Route::get('/new-user', [UserController::class, 'user_create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
	Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/all-property-staff', [UserController::class, 'all_property_staff'])->name('all.property.staff');
    Route::get('/all-resident-staff', [UserController::class, 'all_resident'])->name('all.resident');
	Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');


});


// Staff Route
Route::prefix('/staff-dashboard')->middleware('role:' . \App\Models\Role::STAFF_ROLE)->group(function () {
    Route::get('/', 'StaffController@root')->name('staff.dashboard');
    Route::get('/register', 'StaffController@register')->name('staff.register');
    Route::post('/register', 'StaffController@submitRegister')->name('staff.register');
    Route::get('/users', 'StaffController@users')->name('staff.user.list');
});

// User Route
Route::prefix('/resident-dashboard')->middleware('role:' . \App\Models\Role::RESIDENT_ROLE)->group(function () {
    Route::get('/', 'UserController@root')->name('user.dashboard');
    Route::get('/promotional-pdfs', 'PromotionalPdfController@index')->name('promotional.index');
});