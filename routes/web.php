<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;

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

Route::get('/',[BooksController::class, 'index']);

Auth::routes();

Route::get('/home',[BooksController::class, 'index'])->middleware('auth');

Route::get('/add-book',[BooksController::class,"create"])->middleware('auth');
Route::post('/add-info',[BooksController::class,"store"])->middleware('auth');
Route::get('/delete-book/{id}',[BooksController::class,"delete"])->middleware('auth');
Route::get('/edit-book/{id}',[BooksController::class,"edit"])->middleware('auth');
Route::post('/update-book',[BooksController::class,"update"])->middleware('auth');

Route::get('/search',[BooksController::class,"search"]);

// Route::post('/autocomplete', [BooksController::class, 'autocompleteSearch']);
// Route::post('/searching',[BooksController::class, 'searching']);