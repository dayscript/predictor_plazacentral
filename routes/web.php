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
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', 'HomeController@index')->name('home');
Route::put('users/updatelang/{lang}', 'UsersController@updateLang');
Route::get('terms-and-conditions', 'HomeController@terms');
Route::get('privacy-policy', 'HomeController@privacy');
Route::get('support', 'HomeController@support');
Route::get('rewards', 'HomeController@rewards');
Route::get('ranking', 'HomeController@ranking');
Route::get('predictions', 'HomeController@predictions');
Route::get('how-to-play', 'HomeController@howToPlay');
Route::resource('leagues','LeaguesController');
Route::post('leagues/{league}/invite','LeaguesController@inviteLeague');
Route::get('leagues/join/{code}', 'LeaguesController@join');
Route::post('leagues/join','LeaguesController@joinLeague');
Route::post('leagues/{league}/leave','LeaguesController@leaveLeague');
Route::post('predictions/{group}','PredictionsController@addGroupPrediction');
Route::post('matchpredictions/{match}','PredictionsController@addMatchPrediction');
Route::get('predictions/{prediction}','PredictionsController@show');
Route::get('images/predictions/{group}/{team1}/{team2}','ImagesController@groupPrediction');
Route::get('account','UsersController@account');
Route::post('rankingdata/{page}','UsersController@ranking');
Route::post('users/updatepassword','UsersController@updatePassword');
Route::get('matches/{match}','MatchesController@show');
