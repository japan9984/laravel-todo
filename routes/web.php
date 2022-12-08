<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\FolderController;
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

// Route::group(['middleware' => 'user-guard'], function () {
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('index');

Route::get('/todo/task_create/{folder_id}', [MemoController::class, 'create'])->name('todo.task_create');
Route::post('/todo/task_store/', [MemoController::class, 'store'])->name('todo.task_store');
Route::get('/todo/task_edit/{memo}', [MemoController::class, 'edit'])->name('todo.task_edit')->middleware('user.edit-memo');
Route::post('/todo/task_update/', [MemoController::class, 'update'])->name('todo.task_update');
Route::post('/todo/task_destory/', [MemoController::class, 'destory'])->name('todo.task_destory');

Route::get('/todo/folder_index/', [FolderController::class, 'index'])->name('todo.folder_index');
Route::get('/todo/folder_show/{folder}', [FolderController::class, 'show'])->name('todo.folder_show')->middleware('user');
Route::get('/todo/folder_create/', [FolderController::class, 'create'])->name('todo.folder_create');
Route::post('/todo/folder_store/', [FolderController::class, 'store'])->name('todo.folder_store');
Route::get('/todo/folder_edit/{folder}', [FolderController::class, 'edit'])->name('todo.folder_edit')->middleware('user.edit');
Route::post('/todo/folder_update/', [FolderController::class, 'update'])->name('todo.folder_update');
Route::post('/todo/folder_destory/', [FolderController::class, 'destory'])->name('todo.folder_destory');
// });
