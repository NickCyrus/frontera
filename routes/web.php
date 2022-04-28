<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

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
/*
Route::get('/', function () {
    return view('app');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 

Auth::routes();

*/
Route::post('login', [LoginController::class, 'login']);
Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout'])->name('logout');

Route::get('login', function () {
    return view('login');
})->name('login');
 

Route::group(['middleware' => ['auth'] ], function () {
    Route::get('/', function () { return view('dashboard'); });
    Route::get('/dashboard', function () { return view('dashboard'); });
    
});