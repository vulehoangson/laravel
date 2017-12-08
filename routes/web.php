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
Route::get('/test/{str}/{s}','Test@showNotify')->name('vl')->where(['str' => '[0-9]+']);
Route::get('/goiten/{a}/{b}',function($a,$b){
   return redirect()->route('vl',['str' =>$a, 's' => $b ]);
});



Route::get('/book','Test@getBookList');
Route::get('/login','User\LoginController@openFormLogin');
Route::get('/signup','User\SignupController@openFormSignup');
Route::post('/validate','User\LoginController@validateLogin');
Route::post('/validatesignup','User\SignupController@validateSignup');
Route::get('/logout','User\LogoutController@process');
Route::get('/redirectlogin','Ajax\AjaxController@Login');
Route::get('/redirectsignup','Ajax\AjaxController@Signup');
Route::get('/profile/{user_id}','Profile\ProfileController@process');
Route::get('/upload','Topic\UploadController@process');