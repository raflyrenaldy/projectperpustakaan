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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Route::get('/testcode/{id}','borrowController@return');

//member
Route::get('admin/member','memberController@index')->name('member');
Route::get('admin/member/create','memberController@create')->name('createmember');
Route::post('/admin/member/check','memberController@check')->name('nis.check');
Route::post('admin/member/add','memberController@store')->name('addmember');
Route::get('admin/member/show/{nis}','memberController@show')->name('detailmember');
Route::get('admin/member/edit/{nis}','memberController@edit')->name('editmember');
Route::post('admin/member/edit/{nis}','memberController@update')->name('updatemember');
Route::delete('admin/member/delete/{nis}','memberController@destroy')->name('deletemember');

//book
Route::get('admin/book','bookController@index')->name('book');
Route::get('admin/book/create','bookController@create')->name('createbook');
Route::post('admin/book/add','bookController@store')->name('addbook');
Route::get('admin/book/show/{id}','bookController@show')->name('detailbook');
Route::get('admin/book/edit/{id}','bookController@edit')->name('editbook');
Route::post('admin/book/edit/{id}','bookController@update')->name('updatebook');
Route::delete('admin/book/delete/{id}','bookController@destroy')->name('deletebook');

//peminjaman
Route::get('admin/borrow','borrowController@index')->name('borrow');
Route::get('admin/borrow/create','borrowController@create')->name('createborrow');
Route::post('admin/borrow/add','borrowController@store')->name('addborrow');
Route::get('admin/borrow/show/{id}','borrowController@show')->name('detailborrow');
Route::get('admin/borrow/edit/{id}','borrowController@edit')->name('editborrow');
Route::post('admin/borrow/edit/{id}','borrowController@update')->name('updateborrow');
Route::delete('admin/borrow/delete/{id}','borrowController@destroy')->name('deleteborrow');
Route::post('admin/borrow/edit/book/{id}','borrowController@updatebook')->name('updateloanedbook');
Route::post('admin/borrow/add/book/{id}','borrowController@addbook')->name('addloanedbook');
Route::get('admin/borrow/show/{id}/returned','borrowController@returned')->name('returnedbook');
Route::get('admin/borrow/show/{id}/returned/cancel','borrowController@cancelreturn')->name('cancelreturn');

//pengembalian
Route::get('admin/return','returnController@index')->name('return');
Route::get('admin/return/{id}','borrowController@return')->name('returnbook');
Route::get('admin/return/book/{id}','borrowController@returnonebook')->name('returnonebook');
Route::get('admin/return/show/{id}','returnController@show')->name('detailreturn');
Route::delete('admin/return/delete/{id}','returnController@destroy')->name('deletereturn');
