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

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


//Auth::routes();

//Route::get('/dashboard', 'DashboardController@index');









Route::resource('agents', 'AgentController');

Route::resource('members', 'MemberController');

Route::resource('districts', 'DistrictController');

Route::resource('funds', 'FundController');

Route::resource('donations', 'DonationController');



Route::resource('payments', 'PaymentController');
Route::get('/flash','MemberController@flash' );

Route::get('/get-member-chart-data', 'ChartController@getMonthyMemberData');
//Route::get('/test', 'ChartController@getMonthlyMemberData');
