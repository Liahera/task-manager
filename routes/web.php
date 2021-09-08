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
Route::get('/tasks/list/{project_id}',[App\Http\Controllers\TaskController::class, 'taskList'])->name('task.list');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ===================== PROJECTS ======================
Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('project.show') ;
Route::get('/projects/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('project.create') ;
Route::post('/projects/store', [App\Http\Controllers\ProjectController::class, 'store'])->name('project.store');
Route::get('/projects/edit/{id}', [App\Http\Controllers\ProjectController::class, 'edit'])->name('project.edit') ;
Route::post('/projects/update/{id}', [App\Http\Controllers\ProjectController::class, 'update'])->name('project.update') ;
Route::delete('/projects/delete/{id}', [App\Http\Controllers\ProjectController::class, 'destroy'])->name('project.delete') ;
