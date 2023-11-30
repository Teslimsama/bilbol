<?php

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

Route::get('/', function () {
    return view('client.index');
});
Route::get('/about', function () {
    return view('client.about');
});
Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    // Route::post('/home', 'storeUser')->name('home');`
});
// Route::controller(SalaryController::class)->group(function () {
//     Route::get('salary/page', 'salary')->name('salary/page');
//     Route::get('salary/add/page', 'salaryAdd')->middleware('auth')->name('salary/add/page'); // page expenses
//     Route::post('salary/add/save', 'salarySave')->name('salary/add/save'); // save record salary
//     Route::get('salary/edit/{id}', 'salaryEdit'); // view for edit
//     Route::post('salary/update', 'salaryUpdate')->name('salary/update'); // update record expenses
//     Route::put('salary/updatedata/{id}', 'update')->name('salary/update-data');
//     Route::post('salary/delete', 'salaryDelete')->name('salary/delete'); // delete record salary
// });