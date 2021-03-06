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

Route::get('','IndexController@process');
Route::get('/book','Test@getBookList');
Route::get('/login','User\LoginController@openFormLogin');
Route::get('/signup','User\SignupController@openFormSignup');
Route::post('/validate','User\LoginController@validateLogin');
Route::post('/validatesignup','User\SignupController@validateSignup');
Route::get('/logout','User\LogoutController@process');
Route::get('/redirectlogin','Ajax\AjaxController@Login');
Route::get('/redirectsignup','Ajax\AjaxController@Signup');
Route::get('/profile/{id}','Profile\ProfileController@process');
Route::get('/upload','Topic\UploadController@process');
Route::post('/upload','Topic\UploadController@process');
Route::get('/admincp','AdminCP\IndexController@process');
Route::post('/topic/approve','Ajax\AjaxController@approveTopic');
Route::post('/topic/remove','Ajax\AjaxController@removeTopic');
Route::post('/topic/search','Topic\SearchController@process');
Route::get('/topic/search','Topic\SearchController@process');
Route::get('/ping', 'Solr\SolariumController@search');
Route::get('/suggestion','Ajax\AjaxController@searchSuggestion');
Route::get('/topic/detail/{id}','Topic\DetailController@process');
Route::get('/topic/edit/{id}','Topic\EditController@process');
Route::post('/changelanguage','Ajax\AjaxController@changeLanguage');
Route::get('paging','Ajax\AjaxController@loadMore');

//using it when method post with params
Route::post('/topic/edit/{id}',[
   'uses' => 'Topic\EditController@process',
   'as' => 'edit.route'
]);