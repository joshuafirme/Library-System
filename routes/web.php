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

Route::get('/category-maintenance', 'Maintenance\CategoryCtr@index');
Route::post('/category-maintenance/store', 'Maintenance\CategoryCtr@store');
Route::post('/category-maintenance/update', 'Maintenance\CategoryCtr@update');
Route::get('/category-maintenance/get-cat/{id}', 'Maintenance\CategoryCtr@getCategoryDetails');
Route::get('/get-classification/{category}', 'Maintenance\CategoryCtr@getClassification');