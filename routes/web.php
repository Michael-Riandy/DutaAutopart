<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\CartController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Route::get('/', [EcommerceController::class, 'index']);

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('pages.index');
Route::get('/shop', [EcommerceController::class, 'index'])->name('pages.shop.index');
Route::get('/shop/{product_slug}',[EcommerceController::class,'details'])->name("pages.shop.product.details");

Route::get('/checkout',[CartController::class,'checkout'])->name('pages.checkout');
Route::post('/place-an-order',[CartController::class, 'place_an_order'])->name('pages.cart.place.an.order');
Route::get('/order-confirmation',[CartController::class,'order_confirmation'])->name('pages.order-confirmation');

// Route::get('/pay/redirect', [CartController::class, 'redirectToMidtrans'])->name('redirect.midtrans');
// Route::post('/midtrans/callback', [CartController::class, 'handleCallback']);


Route::get('/midtrans/return-back', [CartController::class, 'returnBack'])->name('midtrans.return.back');
Route::get('/midtrans/finish', [CartController::class, 'midtransFinish'])->name('midtrans.finish');
Route::post('/midtrans/on-close', [CartController::class, 'handleOnClose']);
Route::post('/midtrans/update-status', [CartController::class, 'updateStatus']);

Route::post('/orders/{order}/ajax-check-payment', [CartController::class, 'ajaxCheckPaymentStatus'])->name('orders.ajaxCheckPayment');


Route::get('/live-search', [EcommerceController::class, 'liveSearch'])->name('products.liveSearch');

Route::middleware(['auth'])->group(function(){
    Route::get('/account-dashboard',[AccountController::class,'index'])->name('pages.account');
    Route::get('/account-orders',[UserController::class, 'orders'])->name('pages.orders');
    Route::get('/account-orders/{order_id}/details',[UserController::class, 'order_details'])->name('pages.order.details');
    Route::put('/account-orders/cancel-order',[UserController::class, 'order_cancel'])->name('pages.order.cancel');
    Route::get('/account-orders/{order}/check-payment', [UserController::class, 'checkPaymentStatus'])->name('pages.order.check');


    Route::get('/account-address',[AccountController::class,'account_address'])->name('pages.account.address');

    Route::get('/cart',[CartController::class,'index'])->name('pages.cart.index');
    Route::post('/cart/store', [CartController::class, 'add_to_cart'])->name('pages.cart.store');
    Route::put('/cart/increase-quantity/{rowId}', [CartController::class, 'increase'])->name('pages.cart.qty.increase');
    Route::put('/cart/decrease-quantity/{rowId}', [CartController::class, 'decrease'])->name('pages.cart.qty.decrease');
    Route::delete('/cart/remove/{rowId}',[CartController::class,'remove'])->name('pages.cart.remove');
    Route::delete('/cart/clear',[CartController::class,'empty_cart'])->name('pages.cart.empty');

    Route::get('/contact-us',[HomeController::class,'contact'])->name('pages.contact');
    Route::post('/contact/store', [HomeController::class, 'contact_store'])->name('pages.contact.store');


    Route::get('/about-us',[HomeController::class,'about'])->name('pages.about');
});






Route::middleware([AuthAdmin::class])->group(function(){
    Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
    
    Route::get('/admin/brands',[BrandsController::class,'index'])->name('admin.brands');
    Route::get('/admin/brand/add',[BrandsController::class,'create'])->name('admin.brand.add');
    Route::post('/admin/brand/store',[BrandsController::class,'store'])->name('admin.brand.store');
    Route::get('/admin/brand/edit/{id}',[BrandsController::class,'edit'])->name('admin.brand.edit');
    Route::put('/admin/brand/update',[BrandsController::class,'update'])->name('admin.brand.update');
    Route::delete('/admin/brand/{id}/delete',[BrandsController::class,'destroy'])->name('admin.brand.delete');
   
    Route::get('/admin/categories',[CategoriesController::class,'index'])->name('admin.categories');
    Route::get('/admin/categories/add',[CategoriesController::class,'create'])->name('admin.categories.add');
    Route::post('/admin/categories/store',[CategoriesController::class,'store'])->name('admin.categories.store');
    Route::get('/admin/categories/edit/{id}',[CategoriesController::class,'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/update',[CategoriesController::class,'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{id}/delete',[CategoriesController::class,'destroy'])->name('admin.categories.delete');

    Route::get('/admin/suppliers',[SuppliersController::class,'index'])->name('admin.suppliers');
    Route::get('/admin/suppliers/add',[SuppliersController::class,'create'])->name('admin.supplier.add');
    Route::post('/admin/suppliers/store',[SuppliersController::class,'store'])->name('admin.supplier.store');
    Route::get('/admin/suppliers/edit/{id}',[SuppliersController::class,'edit'])->name('admin.supplier.edit');
    Route::put('/admin/suppliers/update',[SuppliersController::class,'update'])->name('admin.supplier.update');
    Route::delete('/admin/suppliers/{id}/delete',[SuppliersController::class,'destroy'])->name('admin.supplier.delete');

    Route::get('/admin/products',[ProductsController::class,'index'])->name('admin.products');
    Route::get('/admin/product/add',[ProductsController::class,'create'])->name('admin.product.add');
    Route::post('/admin/product/store',[ProductsController::class,'store'])->name('admin.product.store');
    Route::get('/admin/product/edit/{id}',[ProductsController::class,'edit'])->name('admin.product.edit');
    Route::put('/admin/product/update',[ProductsController::class,'update'])->name('admin.product.update');
    Route::delete('/admin/product/{id}/delete',[ProductsController::class,'destroy'])->name('admin.product.delete');

    Route::get('/admin/orders',[AdminController::class,'orders'])->name('admin.orders');
    Route::get('/admin/order/{order_id}/details',[AdminController::class, 'order_details'])->name('admin.order.details');
    Route::put('/admin/order/update-status',[AdminController::class, 'update_order_status'])->name('admin.order.status.update');

    Route::get('/admin/slides',[AdminController::class, 'slides'])->name('admin.slides');
    Route::get('/admin/slide/add',[AdminController::class, 'slide_add'])->name('admin.slide.add');
    Route::post('/admin/slide/store',[AdminController::class,'slide_store'])->name('admin.slide.store');
    Route::get('/admin/slide/edit/{id}',[AdminController::class,'slide_edit'])->name('admin.slide.edit');
    Route::put('/admin/slide/update',[AdminController::class,'slide_update'])->name('admin.slide.update');
    Route::delete('/admin/slide/{id}/delete',[AdminController::class,'slide_delete'])->name('admin.slide.delete');

    Route::get('/admin/contact',[AdminController::class, 'contacts'])->name('admin.contacts');
    Route::delete('/admin/contact/{id}/delete',[AdminController::class,'contact_delete'])->name('admin.contact.delete');

    Route::get('/admin/search',[AdminController::class,'search'])->name('admin.search');
});