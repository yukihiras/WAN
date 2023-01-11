<?php

use Illuminate\Support\Facades\Route;

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


//ADMIN
Route::get('/dashboard', "AdminController\DashboardController@dashboard")->name('dashboardRoute');

//USERS
Route::get('/users', "AdminController\UsersController@loadList")->name('listUsersRoute');
Route::match(['get', 'post'],'/users/add', "AdminController\UsersController@add")->name('addUsersRoute');
Route::get('/users/delete/{id}', 'AdminController\UsersController@delete')->name('deleteUsersRoute');
Route::get('/users/detail/{id}', 'AdminController\UsersController@detail')->name('detailUsersRoute');
Route::post('/users/update/{id}', 'AdminController\UsersController@update')->name('updateUsersRoute');





