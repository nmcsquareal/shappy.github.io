<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/redirect',[HomeController::class, 'redirect'])->middleware('auth','verified')->name('redirect');
Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/view_category',[AdminController::class, 'view_category'])->name('view_category');
Route::post('/add_category',[AdminController::class, 'add_category'])->name('add_category');
Route::get('/delete_category/{id}',[AdminController::class, 'delete_category'])->name('delete_category');
Route::get('/delete_product/{id}',[AdminController::class, 'delete_product'])->name('delete_product');

Route::get('/view_product',[AdminController::class, 'view_product'])->name('view_product');
Route::post('/add_product',[AdminController::class, 'add_product'])->name('add_product');
Route::get('/show_product',[AdminController::class, 'show_product'])->name('show_product');
Route::get('/update_product/{id}',[AdminController::class, 'update_product'])->name('update_product');
Route::post('/update_product_confirm/{id}',[AdminController::class, 'update_product_confirm'])->name('update_product_confirm');
Route::get('/order_product',[AdminController::class, 'order_product'])->name('order_product');
Route::get('/delivered/{id}',[AdminController::class, 'delivered'])->name('delivered');
Route::get('/print_pdf/{id}',[AdminController::class, 'print_pdf'])->name('print_pdf');
Route::get('/send_email/{id}',[AdminController::class, 'send_email'])->name('send_email');
Route::post('/send_user_email/{id}',[AdminController::class, 'send_user_email'])->name('send_user_email');
Route::get('/search',[AdminController::class, 'searchdata'])->name('search');


Route::get('/product_details/{id}',[HomeController::class, 'product_details'])->name('product_details');

Route::get('/show_cart',[HomeController::class, 'show_cart'])->name('show_cart');
Route::post('/add_cart/{id}',[HomeController::class, 'add_cart'])->name('add_cart');

Route::get('/remove_cart/{id}',[HomeController::class, 'remove_cart'])->name('remove_cart');

Route::get('/checkout',[HomeController::class, 'checkout'])->name('checkout');
Route::get('/cash_order',[HomeController::class, 'cash_order'])->name('cash_order');
Route::get('/stripe/{totalPrice}',[HomeController::class, 'stripe'])->name('stripe');
Route::post('stripe/{totalPrice}', [HomeController::class,'stripePost'])->name('stripe.post');

Route::get('/show_order',[HomeController::class, 'show_order'])->name('show_order');
Route::get('/cancel_order/{id}',[HomeController::class, 'cancel_order'])->name('cancel_order');
Route::get('/remove_cancel_order/{id}',[HomeController::class, 'remove_cancel_order'])->name('remove_cancel_order');

Route::post('/add_comment',[HomeController::class, 'add_comment'])->name('add_comment');
Route::post('/add_reply',[HomeController::class, 'add_reply'])->name('add_reply');

Route::get('/product_search',[HomeController::class, 'product_search'])->name('product_search');

Route::get('/products',[HomeController::class, 'products'])->name('products');

Route::get('/search_product',[HomeController::class, 'search_product'])->name('search_product');


