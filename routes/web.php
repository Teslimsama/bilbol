<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RentedController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::middleware('guest')->group(function () {
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/forgot_password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('password/email', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset_password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset_password', [NewPasswordController::class, 'store'])
        ->name('password.update');

    Route::patch('update-cart', [RentedController::class, 'update'])->name('update_cart');

    Route::get('add-to-cart/{id}', [RentedController::class, 'addToCart'])->name('add_to_cart');

    Route::delete('remove-from-cart', [RentedController::class, 'remove'])->name('remove_from_cart');

    Route::controller(ClientController::class)->group(function () {
        Route::get('/index',  'index')->name('index');
        Route::get('/',  'index')->name('home');
        Route::get('/about',  'about')->name('about');
        Route::get('/shop',  'shop')->name('shop');
        Route::get('/furniture',  'furniture')->name('furniture');
        Route::get('/contact',  'contact')->name('contact');
        Route::get('/cart',  'cart')->name('cart');
        Route::get('/checkout',  'checkout')->name('checkout');
    });
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/loginnow', 'authenticate')->name('loginnow');
        Route::post('change/password', 'changePassword')->name('change/password');
    });
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/registernow', 'storeUser')->name('registernow');
    });
});

Route::middleware('auth')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard',  'dashboard')->name('dashboard');
    });
    Route::controller(LoginController::class)->group(function () {
        Route::get('/logout', 'logout')->name('logout');
    });
    Route::prefix('inventory')->group(function () {
        Route::get('/', [InventoryController::class, 'inventory'])->name('inventory');
        Route::get('/add', [InventoryController::class, 'inventoryAdd'])->name('inventory.add');
        Route::post('/save', [InventoryController::class, 'store'])->name('inventory.save');
        Route::get('/edit/{id}', [InventoryController::class, 'edit'])->name('inventory.edit');
        Route::post('/update', [InventoryController::class, 'update'])->name('inventory.update');
        Route::post('/delete', [InventoryController::class, 'delete'])->name('inventory.delete');
    });


    Route::get('/findPricePurchase', 'PurchaseController@findPricePurchase')->name('findPricePurchase');

    Route::controller(UsersController::class)->group(function () {
        Route::get('/users',  'users')->name('users');
        Route::post('/users/save',  'store')->name('users.save');
        Route::get('/users/add',  'create')->name('users.add');
        Route::post('/users/update',  'update')->name('users.update');
        Route::post('/users/delete',  'delete')->name('users.delete');
        Route::get('/users/edit/{id}',  'edit')->name('users.edit');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category',  'index')->name('category');
        Route::post('/category/save',  'store')->name('category.save');
        Route::get('/category/add',  'create')->name('category.add');
        Route::post('/category/update',  'update')->name('category.update');
        Route::post('/category/delete',  'delete')->name('category.delete');
        Route::get('/category/edit/{id}', 'edit')->name('category.edit');
    });
    Route::controller(RentedController::class)->group(function () {
        Route::get('/rented',  'index')->name('rented');
        Route::get('/rented/add',  'rentedAdd')->name('rented.add');
        Route::post('/rented/save',  'store')->name('rented.save');
        Route::get('/rented/show/{id}',  'show')->name('rented.show');
        Route::post('/rented/update',  'update')->name('rented.update');
        Route::get('/rented/edit/{id}',  'edit')->name('rented.edit');
        // Route::get('/getProductUser', 'getProductUser');
        Route::post('/rented/delete',  'destroy')->name('rented.delete');
        Route::get('/findPrice', 'findPrice')->name('findPrice');
    });
});

// Other routes...
