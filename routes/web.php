<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Client
// Route::get('/', [HomeController::class, 'index']);



// ***************** Admin *****************
// -----Categories
// Route::resource('admin/categories', CategoriesController::class);
//  GET
// Route::get('/admin/categories', [CategoriesController::class, 'index'])->name('admin.categories.index');

// // POST
// Route::get('/admin/categories/create', [CategoriesController::class, 'create'])->name('admin.categories.create');
// Route::post('/admin/categories', [CategoriesController::class, 'store'])->name('admin.categories.store');

// // UPDATE
// Route::get('/admin/categories/{category}', [CategoriesController::class, 'edit'])->name('admin.categories.update');
// Route::put('/admin/categories/{category}', [CategoriesController::class, 'update'])->name('admin.categories.update');

Route::group(['middleware' => 'auth'], function () {

	Route::get('/', [HomeController::class, 'home']);
	Route::get('admin/dashboard', function () {
		return view('admin.dashboard');
	})->name('dashboard');

	Route::get('admin/billing', function () {
		return view('admin.billing');
	})->name('billing');

	Route::get('admin/user-management', function () {
		return view('admin.laravel-navigation.user-management');
	})->name('user-management');

	// ******************* Categories route *******************
	Route::controller(CategoriesController::class)->group(function () {
		Route::get('admin/categories-management', 'index')->name('categories-management');
		Route::get('admin/categories-management-create', 'create');
		Route::post('admin/categories-management', 'store');
		Route::get('admin/categories-management-edit/{id}', 'edit')->name('categories-management-edit');
		Route::put('admin/categories-management/update/{id}', 'update');
		Route::delete('admin/categories-management/delete/{id}', 'destroy');
	});

	// ******************* Product route *******************
	Route::controller(ProductsController::class)->group(function () {
		Route::get('admin/products-management', 'index')->name('products-management');
		Route::get('admin/products-management-create', 'create');
		Route::post('admin/products-management', 'store');
		Route::get('admin/products-management-edit/{id}', 'edit')->name('products-management-edit');
		Route::put('admin/products-management/update/{id}', 'update');
		Route::delete('admin/products-management/delete/{id}', 'destroy');
	});

	// ******************* Order route *******************
	Route::controller(OrderController::class)->group(function () {
		Route::get('admin/orders-management', 'index')->name('orders-management');
		// Route::post('admin/orders-management', [OrderController::class, 'store']);
		// Route::get('admin/orders-management-edit/{id}', 'edit')->name('orders-management-edit');
		Route::put('admin/orders-management/update/{id}', 'update');
		Route::delete('admin/orders-management/delete/{id}', 'destroy');
	});

	// ******************* User route *******************
	Route::controller(UsersController::class)->group(function () {
		Route::get('admin/users-management', 'index')->name('users-management');
		Route::get('admin/users-management-create', 'create');
		Route::post('admin/users-management', 'store');
		Route::get('admin/users-management-edit/{id}', 'edit');
		Route::put('admin/users-management/update/{id}', 'update');
		Route::delete('admin/users-management/delete/{id}', 'destroy');
	});

	// ******************* Profile route *******************
	Route::get('admin/user-profile', function () {
		return view('admin.laravel-navigation.user-profile');
	})->name('user-profile');
	Route::post('admin/user-profile', [InfoUserController::class, 'store']);

	// ******************* Conversation route *******************
	// Route::controller(UsersController::class)->group(function () {
	// 	Route::get('admin/users-management', 'index')->name('users-management');
	// 	Route::get('admin/users-management-create', 'create');
	// 	Route::post('admin/users-management', 'store');
	// 	Route::get('admin/users-management-edit/{id}', 'edit');
	// 	Route::put('admin/users-management/update/{id}', 'update');
	// 	Route::delete('admin/users-management/delete/{id}', 'destroy');
	// });


	// Route::get('admin/customers-management', function () {
	// 	return view('admin/laravel-navigation/customers-management');
	// })->name('customers-management');

	// Route::get('admin/orders-management', function () {
	// 	return view('admin/laravel-navigation/orders-management');
	// })->name('orders-management');

	Route::get('admin/tables', function () {
		return view('admin/tables');
	})->name('tables');

	Route::get('/logout', [SessionsController::class, 'destroy']);
	// Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::get('/login', function () {
		return view('/admin/dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');
