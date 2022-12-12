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

Route::post('sample', 'FormController@postValidates');

// Route::group(['middleware' => 'user-guard'], function () {
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('index');

Route::group(['prefix' => 'todo','as' => 'todo.'],function(){
    Route::get('task_create/folder/{folder}', [MemoController::class, 'create'])->name('task_create');
    Route::post('task_store/folder/{folder}', [MemoController::class, 'store'])->name('task_store');
    Route::get('task_edit/{memo}', [MemoController::class, 'edit'])->name('task_edit')->middleware('user.edit-memo');
    Route::post('task_update/', [MemoController::class, 'update'])->name('task_update');
    Route::post('task_destory/', [MemoController::class, 'destory'])->name('task_destory');

    Route::get('folder_index/', [FolderController::class, 'index'])->name('folder_index');
    Route::get('folder_show/{folder}', [FolderController::class, 'show'])->name('folder_show')->middleware('user');
    Route::get('folder_create/', [FolderController::class, 'create'])->name('folder_create');
    Route::post('folder_store/', [FolderController::class, 'store'])->name('folder_store');
    Route::get('folder_edit/{folder}', [FolderController::class, 'edit'])->name('folder_edit')->middleware('user.edit');
    Route::post('folder_update/', [FolderController::class, 'update'])->name('folder_update');
    Route::post('folder_destory/', [FolderController::class, 'destory'])->name('folder_destory');
});
// });
