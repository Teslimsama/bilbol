<?php
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RentedController;
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
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/forgot_password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('password/email', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset_password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset_password', [NewPasswordController::class, 'store'])
        ->name('password.update');

    Route::controller(ClientController::class)->group(function () {
        Route::get('/',  'index')->name('home');
        Route::get('/about',  'about')->name('about');
        Route::get('/shop',  'shop')->name('shop');
        Route::get('/furniture',  'furniture')->name('furniture');
        Route::get('/contact',  'contact')->name('contact');
    });
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/loginnow', 'authenticate')->name('loginnow');
        Route::get('/logout', 'logout')->name('logout');
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
    Route::prefix('inventory')->group(function () {
        Route::get('/', [InventoryController::class, 'inventory'])->name('inventory');
        Route::get('/add', [InventoryController::class, 'inventoryAdd'])->name('inventory.add');
        Route::post('/save', [InventoryController::class, 'store'])->name('inventory.save');
        Route::get('/edit/{id}', [InventoryController::class, 'edit'])->name('inventory.edit');
        Route::post('/update', [InventoryController::class, 'update'])->name('inventory.update');
        Route::post('/delete', [InventoryController::class, 'delete'])->name('inventory.delete');
    });

    Route::controller(UsersController::class)->group(function () {
        Route::get('/users',  'users')->name('users');
    });
    Route::controller(RentedController::class)->group(function () {
        Route::get('/rented',  'rented')->name('rented');
        Route::get('/rented/add',  'rentedAdd')->name('rented.add');
        Route::get('/rented/save',  'store');
        Route::get('/rented/edit/{id}',  'edit')->name('rented.edit');
    });
});

// Other routes...

