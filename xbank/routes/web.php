<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('start');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search/{val}','HomeController@search');
Route::get('/search/{val}/limit/{lim}','HomeController@searchlim');

// ---- sort

Route::get('/home/desc', 'HomeController@indexdesc');
Route::get('/search/{val}/desc','HomeController@searchdesc');
Route::get('/search/{val}/limit/{lim}/desc','HomeController@searchlimdesc');


Route::get('/home/asc', 'HomeController@indexasc');
Route::get('/search/{val}/asc','HomeController@searchasc');
Route::get('/search/{val}/limit/{lim}/asc','HomeController@searchlimasc');

// ------- edit transaction ----------
Route::get('/transaction/{transaction}','HomeController@show');
Route::post('/transedit{id}', 'TransactionController@update');
Route::post('/transaction', 'TransactionController@insert');
// ------- delete transaction ----------
Route::delete('/transaction/{transaction}', function (\App\Transaction $transaction) {
	$transaction->delete();
    return redirect('/home');
});
// ------- insert customer ----------
Route::post('/customer', 'CustomerController@addCustomer');
Route::get('/report', 'ReportController@insert');

Auth::routes();
