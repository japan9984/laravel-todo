<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\BgController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('index');

Route::group(['prefix' => 'bg','as' => 'bg.'],function(){
    Route::get('create/', [BgController::class, 'create'])->name('create');
    Route::post('store/', [BgController::class, 'store'])->name('store');
    Route::post('destory/', [BgController::class, 'destory'])->name('destory');
});

Route::group(['prefix' => 'memo','as' => 'memo.'],function(){
    Route::get('create/folder/{folder}', [MemoController::class, 'create'])->name('create');
    Route::post('store/folder/{folder}', [MemoController::class, 'store'])->name('store');
    Route::get('edit/{memo}', [MemoController::class, 'edit'])->name('edit')->middleware('user.edit-memo');
    Route::post('update/{memo}', [MemoController::class, 'update'])->name('update');
    Route::post('destory/{memo}', [MemoController::class, 'destory'])->name('destory');
});

Route::group(['prefix' => 'folder','as' => 'folder.'],function(){
    Route::get('index/', [FolderController::class, 'index'])->name('index');
    Route::get('show/{folder}', [FolderController::class, 'show'])->name('show')->middleware('user');
    Route::get('create/', [FolderController::class, 'create'])->name('create');
    Route::post('store/', [FolderController::class, 'store'])->name('store');
    Route::get('edit/{folder}', [FolderController::class, 'edit'])->name('edit')->middleware('user.edit');
    Route::post('update/{folder}', [FolderController::class, 'update'])->name('update');
    Route::post('destory/{folder}', [FolderController::class, 'destory'])->name('destory');
});
