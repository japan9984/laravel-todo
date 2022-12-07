<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

// Route::get('/', [HomeController::class, 'index'])->name('index');
// Route::get('/home', [HomeController::class, 'index'])->name('index');

// Route::get('/memo/create/', [HomeController::class, 'memo_create'])->name('memo.create');
// Route::post('/memo/store/', [HomeController::class, 'memo_store'])->name('memo.store');
// Route::get('/memo/edit/{id}', [HomeController::class, 'memo_edit'])->name('memo.edit');
// Route::post('/memo/update', [HomeController::class, 'memo_update'])->name('memo.update');

// Route::get('/folder/show/{folder}', [HomeController::class, 'folder_show'])->name('folder.show');
// Route::get('/folder/create/', [HomeController::class, 'folder_create'])->name('folder.create');
// Route::post('/folder/store/', [HomeController::class, 'folder_store'])->name('folder.store');




Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('index');

Route::get('/todo/task_create/{folder_id}', [HomeController::class, 'todo_task_create'])->name('todo.task_create');
Route::get('/todo/task_create/{folder}', [HomeController::class, 'todo_task_create2'])->name('todo.task_create2');
Route::post('/todo/task_store/', [HomeController::class, 'todo_task_store'])->name('todo.task_store');
Route::get('/todo/task_edit/{id}', [HomeController::class, 'todo_task_edit'])->name('todo.task_edit');
Route::post('/todo/task_update/', [HomeController::class, 'todo_task_update'])->name('todo.task_update');
Route::post('/todo/task_destory/', [HomeController::class, 'todo_task_destory'])->name('todo.task_destory');

Route::get('/todo/folder_index/', [HomeController::class, 'todo_folder_index'])->name('todo.folder_index');
Route::get('/todo/folder_show/{folder}', [HomeController::class, 'todo_folder_show'])->name('todo.folder_show');
Route::get('/todo/folder_create/', [HomeController::class, 'todo_folder_create'])->name('todo.folder_create');
Route::post('/todo/folder_store/', [HomeController::class, 'todo_folder_store'])->name('todo.folder_store');

Route::get('/todo/folder_edit/{id}', [HomeController::class, 'todo_folder_edit'])->name('todo.folder_edit');
Route::post('/todo/folder_update/', [HomeController::class, 'todo_folder_update'])->name('todo.folder_update');
Route::post('/todo/folder_destory/', [HomeController::class, 'todo_folder_destory'])->name('todo.folder_destory');
// Route::get('/todo/folder_show/{folder}', [HomeController::class, 'todo_folder_show'])->name('todo.folder_show');
// Route::post('/folder/store/', [HomeController::class, 'folder_store'])->name('folder.store');


