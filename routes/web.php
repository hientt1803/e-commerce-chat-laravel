<?php

use App\Http\Controllers\CartDetailController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ShopController;
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

Route::group(['middleware' => 'auth'], function () {
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

	// ******************* Customer route *******************
	Route::controller(CustomersController::class)->group(function () {
		Route::get('admin/customers-management', 'index')->name('customers-management');
		Route::get('admin/customers-management-create', 'create');
		Route::post('admin/customers-management', 'store');
		Route::get('admin/customers-management-edit/{id}', 'edit')->name('customers-management-edit');
		Route::put('admin/customers-management/update/{id}', 'update');
		Route::delete('admin/customers-management/delete/{id}', 'destroy');
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
	Route::controller(ConversionController::class)->group(function () {
		Route::get('admin/conversation-management', 'index')->name('conversation-management');
		Route::get('admin/conversation-management/{id}', 'show');
	});

	// ******************* Conversation route *******************
	Route::controller(MessagesController::class)->group(function () {
		Route::post('admin/messages-management', 'store');
	});

	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/login', function () {
		return view('/admin/dashboard');
	})->name('sign-up');
});

Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create'])->name('login');
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

// Route::get('/login', function () {
// 	return view('session/login-session');
// })->name('login');


// ******************* Client route *******************
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(ShopController::class)->group(function () {
	Route::get('/shop', 'index')->name('shop');
	Route::get('/shop/product-detail/{id}', 'show')->name('productDetail');
	Route::get('/shop/category/{id}', 'filterByCategory')->name('filterByCategory');
	Route::get('/shop/filter-by-price', 'filterByPrice')->name('filterByPrice');
});

Route::controller(CartDetailController::class)->group(function () {
	Route::get('/cart', 'index')->name('cart');
	Route::post('/cart-detail', 'store');
	Route::put('/cart-detail', 'update');
	Route::delete('/cart-detail/{id}', 'destroy');
});

Route::controller(CheckoutController::class)->group(function () {
	Route::post('/check-out-process', 'processCheckout')->name('checkout');
	Route::post('/check-out', 'store');
});

Route::get('/contact', function () {
	return view('client.navigation.contact.index');
})->name('contact');

Route::get('/blog', function () {
	return view('client.navigation.blog.index');
})->name('blog');
