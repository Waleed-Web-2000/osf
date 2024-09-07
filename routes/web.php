<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CartController;

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

 /* PRODUCT CONTROLLER ROUTES */
 
 	 /* Logo CONTROLLER ROUTES */
 	 Route::middleware('auth')->group(function () {
 	Route::prefix('admin')->group(function () {
 	Route::controller(ProductController::class)->group(function () {
 	Route::get('product', 'index')->name('product.all');
 	Route::get('product/create', 'create')->name('product.create');
 	Route::post('product/store', 'store')->name('product.store');
 	Route::get('product/{id}/edit', 'edit')->name('product.edit');
 	Route::put('product/update/{id}', 'update')->name('product.update');
 	Route::get('product/delete/{id}', 'destroy')->name('product.destroy');
 	Route::get('product/{id}/status', 'status')->name('product.status');
 	});
 	});

 	 /* CATEGORY CONTROLLER ROUTES */
 	Route::prefix('admin')->group(function () {
 	Route::controller(CategoryController::class)->group(function () {
 	Route::get('category', 'index')->name('category.all');
 	Route::get('category/create', 'create')->name('category.create');
 	Route::post('category/store', 'store')->name('category.store');
 	Route::get('category/{id}/edit', 'edit')->name('category.edit');
 	Route::put('category/update/{id}', 'update')->name('category.update');
 	Route::get('category/delete/{id}', 'destroy')->name('category.destroy');
 	Route::get('category/{id}/status', 'status')->name('category.status');
 	});
 	});
 	Route::prefix('admin')->group(function () {
 	Route::controller(HomeController::class)->group(function () {
 	Route::get('order', 'orders')->name('admin.order');
 	Route::get('single-order', 'single_orders')->name('admin.single.order');
 	Route::get('order/delete/{id}', 'destroy')->name('order.destroy');	
 	});
 	});
 	Route::prefix('admin')->group(function () {
 	Route::controller(HomeController::class)->group(function () {
 	Route::get('settings', 'setting')->name('settings');
    Route::put('settings/update/{id}', 'update')->name('settings.update');
 	});
 	});
 	});
 	// ...............   admin redirect   ....................... //
 	Route::get('/admin', [HomeController::class, 'login'])->name('login');

 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [HomeController::class, 'profile'])->name('profile');
	Route::post('/admin/profile/update', [HomeController::class, 'profile_update'])->name('profile.update');
	Route::post('/admin/profile/change_password', [HomeController::class, 'change_password'])->name('change.password');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// --------------------- Frontend Controller -------------------- //
	Route::get('/', [MainController::class, 'index'])->name('home');
	Route::get('/shop', [MainController::class, 'shop'])->name('shop');
	Route::get('/about', [MainController::class, 'about'])->name('about');
	Route::get('/contact', [MainController::class, 'contact'])->name('contact');
	Route::get('/product/{slug}',[MainController::class, 'product_detail'])->name('product-detail');
	Route::get('/collection/{slug}',[MainController::class, 'product_category'])->name('product-cat');
	Route::get('/shop_list',[MainController::class, 'shop_list'])->name('product-lists');
	Route::get('/cart',[CartController::class, 'index'])->name('cart.index');
	Route::post('/cart/add',[CartController::class, 'add_to_cart'])->name('cart.add');
	Route::put('/cart/add',[CartController::class, 'add_to_cart'])->name('cart.add');
	Route::put('/cart/increase_cart_quantity/{rowId}',[CartController::class, 'increase_cart_quantity'])->name('cart.quantity.increase');
	Route::put('/cart/decrease_cart_quantity/{rowId}',[CartController::class, 'decrease_cart_quantity'])->name('cart.quantity.decrease');
	Route::delete('/cart/remove/{rowId}',[CartController::class, 'remove_item'])->name('cart.item.remove');
	Route::delete('/cart/clear',[CartController::class, 'empty_cart'])->name('cart.clear');
	Route::get('/checkout',[CartController::class, 'checkout'])->name('cart.checkout');
	Route::post('/place-an-order',[CartController::class, 'place_an_order'])->name('cart.place.an.order');
	Route::post('/place-order',[CartController::class, 'place_order'])->name('cart.place.order');
	Route::get('/order-confirm',[CartController::class, 'order_confirmation'])->name('cart.order.confirm');
	Route::get('/admin/order/{order_id}/details',[HomeController::class, 'order_detail'])->name('order.detail');
	Route::get('/admin/order/{id}/single-details',[HomeController::class, 'single_order_detail'])->name('single.order.detail');
	Route::put('/admin/order/update-status',[HomeController::class,'update_order_status'])->name('admin.order.status.update');
	Route::put('/admin/order/buy-update-status',[HomeController::class,'buy_update_order_status'])->name('admin.buy.order.status.update'); 
