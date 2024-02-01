<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(DataController::class)->name('list')->group(function () {
    Route::get('/{status}', 'index')->name('_show');
    Route::get('/update/{id}', 'update_form')->name('_update_form');
    Route::get('/add', 'add_form')->name('_add_form');

    
    Route::put('/update/{id}', 'update')->name('_update');
    Route::post('/add', 'store')->name('_add');
    Route::delete('/delete/{id}', 'delete')->name('_delete');
});
