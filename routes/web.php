<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/task/index', [TaskController::class, 'index'])->name('task.index');

Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');

Route::get('/task/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');

Route::get('/task/show/{id}', [TaskController::class, 'show'])->name('task.show');

Route::get('/task/list-status', [TaskController::class, 'listStatus'])->name('task.listStatus');

Route::get('/task/list-priority', [TaskController::class, 'listPriority'])->name('task.listPriority');

Route::delete('/task/destroy/{id}', [TaskController::class, 'destroy'])->name('task.destroy');

Route::post('/task/save', [TaskController::class, 'save'])->name('task.save');

Route::put('/task/update/{id}', [TaskController::class, 'update'])->name('task.update');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
