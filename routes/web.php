<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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



//  ----------- Admin --------------
Auth::routes();

Route::get('admin/book', 'AdminController@index')->middleware('auth'); //get
Route::get('admin/book/Deleted', 'AdminController@Deleted')->middleware('auth'); //get

// Create New Book
Route::get('admin/book/create/book', 'AdminController@create_book')->middleware('auth'); //get
Route::post('admin/book/store/book', 'AdminController@store_book')->middleware('auth'); //post

// Create New Author
Route::get('admin/book/create/author', 'AdminController@create_author')->middleware('auth'); //get
Route::post('admin/book/store/author', 'AdminController@store_author')->middleware('auth'); //post

// Create New Publisher
Route::get('admin/book/create/publisher', 'AdminController@create_publisher')->middleware('auth'); //get
Route::post('admin/book/store/publisher', 'AdminController@store_publisher')->middleware('auth'); //post

// Create New Category
Route::get('admin/book/create/category', 'AdminController@create_category')->middleware('auth'); //get
Route::post('admin/book/store/category', 'AdminController@store_category')->middleware('auth'); //post

Route::get('admin/book/edit/{id}', 'AdminController@edit')->middleware('auth'); //get

Route::post('admin/book/update/{id}', 'AdminController@update')->middleware('auth');    //post

Route::post('admin/book/delete/{id}', 'AdminController@destroy')->middleware('auth'); //delete

Route::post('admin/book/restore/{id}', 'AdminController@restore')->middleware('auth'); //delete


// ------------- User -------------

Route::get('/home', 'HomeController@index');
Route::get('/books', 'HomeController@view_books');
Route::get('/book/author/{id}', 'HomeController@view_author_book');
Route::get('/book/publisher/{id}', 'HomeController@view_publisher_book');
Route::get('/book/category/{id}', 'HomeController@view_category_book');
Route::get('/book/{id}', 'HomeController@view_book');


Route::get('/view/authors', 'HomeController@view_authors');
Route::get('/view/categories', 'HomeController@view_categories');
Route::get('/view/publishers', 'HomeController@view_publishers');



// ------------ Search -------------------
Route::get('/search', 'HomeController@search');

