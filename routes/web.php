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
Route::get('/', ['uses'=>'BaseController@index']);
Route::get('/search', ['uses'=>'BaseController@search', 'as'=>'search']);

Route::group(['prefix'=>'account', 'middleware' => 'auth'], function () {
    Route::get('/trashed', ['uses' => 'DomainController@getOnlyTrashed', 'as'=>'all.trashed']);
    Route::get('/restore-trashed/{id}', ['uses' => 'DomainController@restoreInTrash', 'as'=>'restore.trashed']);
    Route::get('/delete-trashed/{id}', ['uses' => 'DomainController@deleteInTrash', 'as'=>'delete.trashed']);
    Route::get('/dynamic-check', ['uses' => 'DomainController@dynamicCheckUpdateForm', 'as'=>'dynamic.check']);
    Route::resource('/domain', 'DomainController');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
