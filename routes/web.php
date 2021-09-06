<?php

use App\Http\Controllers\TaskController;
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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

    Route::get('/logout', function(){
        Auth::logout();
        return redirect(route('login'));
    })->name('logout');
Route::resource('task', TaskController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
