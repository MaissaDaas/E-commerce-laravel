<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashbordController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductRequest;
use App\Http\Controllers\Admin\AddCategoryController;
use App\Http\Controllers\Admin\AddProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AddBrandController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Paralux\HomeController;
use App\Http\Controllers\Paralux\PanierController;
use App\Http\Controllers\Paralux\WishlistController;
use App\Http\Controllers\Paralux\CountController;
use App\Http\Controllers\Paralux\OrderUserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\form;

Route::get('/', function () {
    return view('login');
});

// ****************** Authentification
Route::get('showloginform', [LoginController::class,'showloginform'])->name('login_form')->middleware('count');
Route::get('showsgininform', [LoginController::class,'showsgininform'])->name('signin_form');
Route::get('showsgininform', [LoginController::class,'showsgininform'])->name('signin_form');
Route::post('admin_login', [LoginController::class,'login'])->name('admin_login')->middleware('count');
Route::post('admin_register', [LoginController::class,'register'])->name('admin_register')->middleware('count');
Route::get('logout', [LoginController::class,'logout'])->name('logout');

// ****************** partie admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashbord', function () {
        return view('dashbord'); 
    })->name('admin.dashboard');

    Route::get('showdashbord', [DashbordController::class,'showdashbord'])->name('dashbord');

    Route::get('showcategory', [CategoryController::class,'showcategory'])->name('categoryAdmin');
    Route::get('addcategory', [AddCategoryController::class,'addcategory'])->name('addCategoryAdmin');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('createcategory', [AddCategoryController::class,'createcategory'])->name('createCategoryAdmin');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');

    Route::get('showproduct', [ProductController::class,'showproduct'])->name('productAdmin');
    Route::get('addproduct', [AddProductController::class,'addproduct'])->name('addProductAdmin');
    Route::post('createproduct', [AddProductController::class,'createproduct'])->name('createProductAdmin');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/products/{id}', [ProductController::class, 'update'])->name('product.update');

    Route::get('showbrand', [BrandController::class,'showbrand'])->name('brandAdmin');
    Route::get('addbrand', [AddBrandController::class,'addbrand'])->name('addBrandAdmin');
    Route::delete('/brand/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
    Route::post('createbrand', [AddBrandController::class,'createbrand'])->name('createBrandAdmin');
    Route::get('/brands/{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/brands/{id}', [BrandController::class, 'update'])->name('brand.update');

    Route::get('showorder', [OrderController::class,'showorder'])->name('orderAdmin');
    Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::post('/orders/{id}', [OrderController::class, 'update'])->name('order.update');

    Route::get('showuser', [UserController::class,'showuser'])->name('userAdmin');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

// ****************** partie user
Route::get('showhome', [HomeController::class,'showhome'])->name('home')->middleware('count');
Route::get('countMethod', [CountController::class,'countMethod'])->name('countMethod');
Route::get('/boutique/{category?}', [HomeController::class,'showboutique'])->name('boutique')->middleware('count');
Route::get('showmarque', [HomeController::class,'showmarque'])->name('marque')->middleware('count');
Route::get('showviewmodal', [HomeController::class,'showviewmodal'])->name('viewmodal');
Route::get('loadMoreProducts', [HomeController::class,'loadMoreProducts'])->name('loadMoreProducts');
Route::get('showVisageProducts', [HomeController::class,'showVisageProducts'])->name('showVisageProducts');
Route::get('showventeflash', [HomeController::class,'showventeflash'])->name('showventeflash')->middleware('count');
Route::get('/product/{id}', [HomeController::class, 'viewProduct'])->name('viewProduct')->middleware('count');

// Route::get('showpanier', [PanierController::class,'showpanier'])->name('showpanier')->middleware('auth');
Route::get('showpanier', [PanierController::class,'showpanier'])->name('showpanier')->middleware('count');
Route::post('/add-panier', [PanierController::class, 'addpanier'])->name('addpanier');
Route::delete('/panier/{id}', [PanierController::class, 'destroy'])->name('destroy.product.panier');
Route::get('/panier/{id}/edit', [PanierController::class, 'edit'])->name('panier.edit');
Route::post('/panier/{id}', [PanierController::class, 'update'])->name('panier.update');

Route::get('showwishlist', [WishlistController::class,'showwishlist'])->name('showwishlist')->middleware('count');
Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('destroy.product.wishlist');
Route::post('/add-wishlist', [WishlistController::class, 'addwishlist'])->name('addwishlist');

Route::get('showorderuser', [OrderUserController::class,'showorderuser'])->name('showorderuser')->middleware('count');
Route::post('/createorderuser', [OrderUserController::class, 'createorderuser'])->name('createorderuser');
Route::post('/addAddresse', [OrderUserController::class, 'addAddresse'])->name('add.addresse');
Route::post('/saveAddress', [OrderUserController::class, 'saveAddress'])->name('saveAddress');
Route::get('/updateMethodePaiment/{id}', [OrderUserController::class, 'updateMethodePaiment'])->name('updateMethodePaiment');
Route::get('showAllOrders', [OrderUserController::class,'showAllOrders'])->name('showAllOrders')->middleware('count');

Route::get('/payment', [form::class, 'showPaymentForm'])->name('payment.form');
// Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment-success', [PaymentController::class, 'showPaymentSuccess'])->name('payment.success');
Route::get('/payment-error', [PaymentController::class, 'showPaymentError'])->name('payment.error');


Route::prefix('user')->middleware(['auth', 'user'])->group(function () {
    // Route::get('/dashbord', function () {
    //     return view('home'); 
    // })->name('home');

    // Route::get('showhome', [HomeController::class, 'showhome'])->name('home');
});
