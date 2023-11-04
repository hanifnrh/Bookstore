<?php

use App\Http\Controllers\AdminController;
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
    return view('welcome');
});

Route::get('add', [AdminController::class, 'create'])->name('book.create');
Route::post('store', [AdminController::class, 'store'])->name('book.store');
Route::get('/', [AdminController::class, 'index'])->name('book.index');
Route::get('ascending', [AdminController::class, 'ascending'])->name('book.ascending');
Route::get('descending', [AdminController::class, 'descending'])->name('book.descending');
Route::get('trash', [AdminController::class, 'trash'])->name('book.trash');
Route::get('edit/{id}', [AdminController::class, 'edit'])->name('book.edit');
Route::post('update/{id}', [AdminController::class, 'update'])->name('book.update');
Route::post('delete/{id}', [AdminController::class, 'delete'])->name('book.delete');
Route::post('deletereal/{id}', [AdminController::class, 'deletereal'])->name('book.deletereal');
// Route::get('inner-join', [AdminController::class, 'innerJOIN']);
Route::get('search', [AdminController::class, 'search'])->name('book.search');


