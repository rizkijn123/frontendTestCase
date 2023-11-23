<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\Controller::class, 'index'])->name('home');
Route::post('/addmusic', [App\Http\Controllers\Controller::class, 'addMusic'])->name('addMusic');
Route::post('/delete/{id}', [App\Http\Controllers\Controller::class, 'delete'])->name('delete');
Route::post('/edit', [App\Http\Controllers\Controller::class, 'edit'])->name('edit');
