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


Route::get('/storage/{extra}', function ($extra) {
return redirect('/public/storage/$extra');
})->where('extra', '.*');

Route::get('/css/{extra}', function ($extra) {
return redirect('/public/css/$extra');
})->where('extra', '.*');

Route::get('/img/{extra}', function ($extra) {
return redirect('/public/img/$extra');
})->where('extra', '.*');


Route::get('/cache', function () {
    Artisan::call('view:cache'); // this will do the command line job
});

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
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', 'DashboardCtr@index');
Route::get('/display-borrowed', 'DashboardCtr@displayBorrowed');
Route::get('/display-reserved', 'DashboardCtr@displayReserved');

/*
|--------------------------------------------------------------------------
| OPAC
|--------------------------------------------------------------------------
*/
Route::get('/opac', 'OpacCtr@index');


/*
|--------------------------------------------------------------------------
| Maintenance
|--------------------------------------------------------------------------
*/
Route::get('/book-maintenance', 'Maintenance\BookCtr@index');
Route::post('/book-maintenance/store', 'Maintenance\BookCtr@store');
Route::post('/book-maintenance/import', 'Maintenance\BookCtr@import');
Route::post('/book-maintenance/export', 'Maintenance\BookCtr@export');
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
Route::post('/reserve-book/do-reserve', 'Transaction\ReserveCtr@reserveBook');

Route::get('/approve-reservation', 'Transaction\ReserveCtr@approve_reservation_view');
Route::post('/approve-reservation/approve', 'Transaction\ReserveCtr@approveReservation');
Route::post('/approve-reservation/decline', 'Transaction\ReserveCtr@declineReservation');

Route::get('/for-release', 'Transaction\ForReleaseCtr@index');
Route::post('/for-release/do-release', 'Transaction\ForReleaseCtr@release');

Route::get('/borrow-book', 'Transaction\BorrowCtr@index');
Route::get('/search-user/{user_id}', 'Transaction\BorrowCtr@searchUser');
Route::post('/borrow-book/do-borrow', 'Transaction\BorrowCtr@borrow');

Route::get('/return-book', 'Transaction\ReturnCtr@index');
Route::get('/get-borrowed-details/{user_id}/{accession_no}', 'Transaction\ReturnCtr@getBorrowedDetails');
Route::post('/return-book/do-return', 'Transaction\ReturnCtr@return');

Route::get('/penalty-payment', 'Transaction\PenaltyPaymentCtr@index');
Route::post('/penalty-payment/do-pay', 'Transaction\PenaltyPaymentCtr@pay');
Route::get('/penalty-payment-paid', 'Transaction\PenaltyPaymentCtr@displayPaid');
Route::get('/getBookAmoutIfLoss/{accession_no}', 'Transaction\PenaltyPaymentCtr@getBookAmoutIfLoss');

/*
|--------------------------------------------------------------------------
| Reports
|--------------------------------------------------------------------------
*/
Route::get('/borrowed-report', 'Reports\BorrowedReportCtr@index');
Route::get('/borrowed-report/print/{date_from}/{date_to}', 'Reports\BorrowedReportCtr@previewReport');

Route::get('/returned-report', 'Reports\ReturnedReportCtr@index');
Route::get('/returned-report/print/{date_from}/{date_to}', 'Reports\ReturnedReportCtr@previewReport');

Route::get('/overdue-report', 'Reports\OverdueReportCtr@index');
Route::get('/overdue-report/print/{date_from}/{date_to}', 'Reports\OverdueReportCtr@previewReport');

Route::get('/unreturned-report', 'Reports\UnreturnedReportCtr@index');
Route::get('/unreturned-report/print/{date_from}/{date_to}', 'Reports\UnreturnedReportCtr@previewReport');

Route::get('/loss-report', 'Reports\LossReportCtr@index');
Route::get('/loss-report/print/{date_from}/{date_to}', 'Reports\LossReportCtr@previewReport');

Route::get('/weed-report', 'Reports\WeedReportCtr@index');
Route::get('/weed-report/print/{date_from}/{date_to}', 'Reports\WeedReportCtr@previewReport');

Route::get('/penalty-report', 'Reports\PenaltyReportCtr@index');
Route::get('/penalty-report/print/{date_from}/{date_to}', 'Reports\PenaltyReportCtr@previewReport');

Route::get('/visitors-log-report', 'Reports\VisitorsLogReportCtr@index');
Route::get('/visitors-log-report/print/{date_from}/{date_to}', 'Reports\VisitorsLogReportCtr@previewReport');

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
Route::get('/user-details/{user_id}', 'Utilities\UserCtr@getUserDetails');
Route::post('/user-maintenance/archive', 'Utilities\UserCtr@archive');
Route::post('/user-maintenance/import', 'Utilities\UserCtr@import');
Route::post('/user-maintenance/export', 'Utilities\UserCtr@export');

Route::get('/audit-trail', 'Utilities\AuditTrailCtr@index');

Route::get('/archive', 'Utilities\ArchiveCtr@index');
Route::post('/archive/retrieve-user', 'Utilities\ArchiveCtr@retrieve');

Route::get('/backup-and-restore', 'Utilities\BackupAndRestoreCtr@index');
Route::post('/backup-and-restore/backup', 'Utilities\BackupAndRestoreCtr@backup');
Route::post('/backup-and-restore/restore', 'Utilities\BackupAndRestoreCtr@restore');


/*
|--------------------------------------------------------------------------
| Visitor's Log
|--------------------------------------------------------------------------
*/
Route::get('/visitors-log-admin', 'VisitorsLogCtr@index');

Route::get('/visitors-log', 'VisitorsLogCtr@visitors_in_out_view');
Route::post('/visitors-log/do-in/{user_id}', 'VisitorsLogCtr@visitorIn');
Route::post('/visitors-log/do-out/{user_id}', 'VisitorsLogCtr@visitorOut');