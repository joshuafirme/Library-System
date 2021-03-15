<?php

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

Route::get('/login', 'LoginCtr@index');

Route::get('/dashboard', 'DashboardCtr@index');

/*
|--------------------------------------------------------------------------
| Maintenance
|--------------------------------------------------------------------------
*/
Route::get('/book-maintenance', 'Maintenance\BookCtr@index');
Route::post('/book-maintenance/store', 'Maintenance\BookCtr@store');
Route::post('/book-maintenance/update', 'Maintenance\BookCtr@update');
Route::post('/book-maintenance/weed/{book_id}', 'Maintenance\BookCtr@weed');

Route::get('/sub-category-maintenance', 'Maintenance\SubCategoryCtr@index');
Route::post('/sub-category-maintenance/store', 'Maintenance\SubCategoryCtr@store');
Route::post('/sub-category-maintenance/update', 'Maintenance\SubCategoryCtr@update');