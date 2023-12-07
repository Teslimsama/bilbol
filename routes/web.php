<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
<<<<<<< HEAD
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
=======
>>>>>>> parent of f518edf (login works now)
use App\Http\Controllers\Auth\RegisterController;

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

Route::controller(AdminController::class)->group(function () {
<<<<<<< HEAD
    Route::get('/dashboard',  'dashboard')->name('dashboard');
    // Route::get('/forgot_password',  'forgot_password')->name('forgot_password');
=======
    Route::get('/login',  'login')->name('login');
    Route::get('/forgot_password',  'forgot_password')->name('forgot_password');
>>>>>>> parent of f518edf (login works now)
});

Route::controller(RegisterController::class)->group(function(){
    Route::get('/register', 'register')->name('register');
    Route::post('/registernow', 'storeUser')->name('registernow');
    
});
// Route::controller(SalaryController::class)->group(function () {
//     Route::get('salary/page', 'salary')->name('salary/page');
//     Route::get('salary/add/page', 'salaryAdd')->middleware('auth')->name('salary/add/page'); // page expenses
//     Route::post('salary/add/save', 'salarySave')->name('salary/add/save'); // save record salary
//     Route::get('salary/edit/{id}', 'salaryEdit'); // view for edit
//     Route::post('salary/update', 'salaryUpdate')->name('salary/update'); // update record expenses
//     Route::put('salary/updatedata/{id}', 'update')->name('salary/update-data');
//     Route::post('salary/delete', 'salaryDelete')->name('salary/delete'); // delete record salary
<<<<<<< HEAD
// });
=======
// });
>>>>>>> parent of f518edf (login works now)
