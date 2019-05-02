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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('home');


// Route::get('/testcode/{id}','borrowController@return');

//member
Route::get('member','memberController@index')->name('member');
Route::get('member/create','memberController@create')->name('createmember');
Route::post('/member/check','memberController@check')->name('nis.check');
Route::post('member/add','memberController@store')->name('addmember');
Route::get('member/show/{nis}','memberController@show')->name('detailmember');
Route::get('member/edit/{nis}','memberController@edit')->name('editmember');
Route::post('member/edit/{nis}','memberController@update')->name('updatemember');
Route::delete('member/delete/{nis}','memberController@destroy')->name('deletemember');

//book
Route::get('book','bookController@index')->name('book');
Route::get('book/create','bookController@create')->name('createbook');
Route::post('book/add','bookController@store')->name('addbook');
Route::get('book/show/{id}','bookController@show')->name('detailbook');
Route::get('book/edit/{id}','bookController@edit')->name('editbook');
Route::post('book/edit/{id}','bookController@update')->name('updatebook');
Route::delete('book/delete/{id}','bookController@destroy')->name('deletebook');

//peminjaman
Route::get('borrow','borrowController@index')->name('borrow');
Route::get('borrow/create','borrowController@create')->name('createborrow');
Route::post('borrow/add','borrowController@store')->name('addborrow');
Route::get('borrow/show/{id}','borrowController@show')->name('detailborrow');
Route::get('borrow/edit/{id}','borrowController@edit')->name('editborrow');
Route::post('borrow/edit/{id}','borrowController@update')->name('updateborrow');
Route::delete('borrow/delete/{id}','borrowController@destroy')->name('deleteborrow');
Route::post('borrow/edit/book/{id}','borrowController@updatebook')->name('updateloanedbook');
Route::post('borrow/add/book/{id}','borrowController@addbook')->name('addloanedbook');
Route::get('borrow/show/{id}/returned','borrowController@returned')->name('returnedbook');
Route::get('borrow/show/{id}/returned/cancel','borrowController@cancelreturn')->name('cancelreturn');

//pengembalian
Route::get('return','returnController@index')->name('return');
Route::get('return/{id}','borrowController@return')->name('returnbook');
Route::get('return/book/{id}','borrowController@returnonebook')->name('returnonebook');
Route::get('return/show/{id}','returnController@show')->name('detailreturn');
Route::delete('return/delete/{id}','returnController@destroy')->name('deletereturn');
