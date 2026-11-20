<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AdminController;
Route::get('/',[StoreController::class,'home'])->name('home');
Route::get('/product/{product}',[StoreController::class,'show'])->name('product.show');
Route::post('/cart/add/{product}',[StoreController::class,'addToCart'])->name('cart.add');
Route::get('/cart',[StoreController::class,'cart'])->name('cart');
Route::post('/cart/update',[StoreController::class,'updateCart'])->name('cart.update');
Route::get('/checkout',[StoreController::class,'checkout'])->name('checkout');
Route::post('/checkout',[StoreController::class,'placeOrder'])->name('checkout.place');
Route::get('/admin',[AdminController::class,'login'])->name('admin.login');
Route::post('/admin/login',[AdminController::class,'authenticate'])->middleware('throttle:5,1')->name('admin.authenticate');
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function(){
 Route::get('/orders',[AdminController::class,'orders'])->name('orders');
 Route::patch('/orders/{order}/status',[AdminController::class,'updateStatus'])->name('orders.status');
 Route::post('/logout',[AdminController::class,'logout'])->name('logout');
});
