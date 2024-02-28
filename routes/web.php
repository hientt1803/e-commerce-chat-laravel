<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Models\Categories;
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

	Route::get('admin/profile', function () {
		return view('admin.laravel-navigation.user-profile');
	})->name('profile');

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
	// Route::resource('admin/categories-management', CategoriesController::class);

	// ******************* Product route *******************
	// Get
	Route::get('admin/products-management', [ProductsController::class, 'index'])->name('products-management');

	// create
	Route::get('admin/products-management-create', [ProductsController::class, 'create']);
	Route::post('admin/products-management', [ProductsController::class, 'store']);


	Route::get('admin/customers-management', function () {
		return view('admin/laravel-navigation/customers-management');
	})->name('customers-management');

	Route::get('admin/orders-management', function () {
		return view('admin/laravel-navigation/orders-management');
	})->name('orders-management');

	Route::get('admin/tables', function () {
		return view('admin/tables');
	})->name('tables');

	// Route::get('virtual-reality', function () {
	// 	return view('virtual-reality');
	// })->name('virtual-reality');

	// Route::get('static-sign-in', function () {
	// 	return view('static-sign-in');
	// })->name('sign-in');

	// Route::get('static-sign-up', function () {
	// 	return view('static-sign-up');
	// })->name('sign-up');

	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::get('/login', function () {
		return view('dashboard');
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
