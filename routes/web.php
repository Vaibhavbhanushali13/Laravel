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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', array('as'=>'login','uses'=>'LoginController@getLogin'));
Route::get('/login', array('as'=>'login','uses'=>'LoginController@getLogin'));
Route::post('/login', array('as'=>'login','uses'=>'LoginController@postLogin'));

Route::middleware(['api'])->group(function ($router) {
  Route::get('/dashboard', array('as'=>'dashboard','uses'=>'LoginController@getDashboard'));
  Route::get('/logout', array('as'=>'logout','uses'=>'LoginController@logoutAdmin'));
  Route::get('/mcq-test', array('as'=>'mcq-test','uses'=>'guestController@mcqInstruction'));
  Route::post('/submit-quiz', array('as'=>'submit-quiz','uses'=>'guestController@submitQuiz'));

});
