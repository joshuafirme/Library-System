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


/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/
Route::get('/', 'LoginCtr@index');

Route::post('/do-login', 'LoginCtr@login');
Route::get('/do-logout', 'LoginCtr@logout');


/*
|--------------------------------------------------------------------------
| Maintenance
|--------------------------------------------------------------------------
*/
Route::get('/book-maintenance', 'Maintenance\BookCtr@index');
Route::post('/book-maintenance/store', 'Maintenance\BookCtr@store');
Route::post('/book-maintenance/import', 'Maintenance\BookCtr@import');
Route::post('/book-maintenance/update', 'Maintenance\BookCtr@update');
Route::get('/book-details/{id}', 'Maintenance\BookCtr@getBookDetails');
Route::post('/book-maintenance/weed', 'Maintenance\BookCtr@weed');
Route::get('/getAccessionNo_ajax', 'Maintenance\BookCtr@getAccessionNo_ajax');

Route::get('/category-maintenance', 'Maintenance\CategoryCtr@index');
Route::post('/category-maintenance/store', 'Maintenance\CategoryCtr@store');
Route::post('/category-maintenance/update', 'Maintenance\CategoryCtr@update');
Route::get('/category-maintenance/get-cat/{id}', 'Maintenance\CategoryCtr@getCategoryDetails');
Route::get('/get-classification/{category}', 'Maintenance\CategoryCtr@getClassification');

Route::get('/weed-maintenance', 'Maintenance\WeedBookCtr@index');
Route::post('/weed-maintenance/retrieve', 'Maintenance\WeedBookCtr@retrieve');

Route::get('/penalty-maintenance', 'Maintenance\PenaltyCtr@index');
Route::post('/penalty-maintenance/activate', 'Maintenance\PenaltyCtr@activate');

/*
|--------------------------------------------------------------------------
| Transaction
|--------------------------------------------------------------------------
*/
Route::get('/book-search', 'Transaction\BookSearchCtr@index');

Route::get('/reserve-book', 'Transaction\ReserveCtr@index');

/*
|--------------------------------------------------------------------------
| Utilities
|--------------------------------------------------------------------------
*/
Route::get('/user-maintenance', 'Utilities\UserCtr@index');
Route::get('/display-student', 'Utilities\UserCtr@displayStudent');
Route::get('/display-teacher', 'Utilities\UserCtr@displayTeacher');
Route::post('/user-maintenance/store', 'Utilities\UserCtr@store');
Route::post('/user-maintenance/update', 'Utilities\UserCtr@update');
Route::get('/student-details/{user_id}', 'Utilities\UserCtr@getStudentDetails');
Route::post('/user-maintenance/archive', 'Utilities\UserCtr@archive');