<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
IDEAS:
  [ ] Calculate which games matter most to me during a competition week
  [ ] Compare my current week against a single opponent (head-to-head)
  [ ] Look back at my historical picks

**/

Route::group(['middleware' => ['web']], function () {
	Route::auth();
	Route::get('/', function () {
		if(Auth::check()) {
			return redirect('home');
		} else {
		    return view('welcome');
		}
	});
});

	Route::get('/home', 'HomeController@index');

	Route::group(['prefix' => ''], function(){
	    Route::resource('games','GamesController');
	});

	Route::group(['prefix' => 'api/v1'], function(){
	    Route::resource('teams','TeamsController');
	});

	Route::get('/picks', 'PicksController@makepicks');
	Route::post('picks/submit', 'PicksController@store');
	Route::get('/view-picks', 'PicksController@viewpicks');
	Route::get('/view-my-picks', 'PicksController@viewmypicks');
	Route::get('/view-my-season-summary', 'PicksController@viewmysummary');

	Route::get('/chat', 'ChatsController@index');
	Route::get('/chat/create', 'ChatsController@create');
	Route::post('/chat', 'ChatsController@store');

	Route::get('/whats-new', 'PagesController@rules');

	Route::get('/nfl-season', 'PagesController@nflSeason');
	Route::get('/nfl-data', function() {
		return view('pages.nfl-data');
	});

	Route::get('/clear-cache', function() {
	    $exitCode = Artisan::call('cache:clear');
	    // return what you want
	});

	Route::post('/chat/new', 'ChatsController@store');

	Route::get('/scoring/live', 'ScoringController@livescoring');
	// Route::get('/scoring/update', 'ScoringController@updategamedetails');
	Route::get('/scoring/update', 'ScoringController@updategamedetails2021');
	Route::get('/scoreboard', 'ScoringController@livescoreboard');

	Route::get('/send-reminders', 'RemindersController@sendreminders');

	Route::get('/admin', 'AdminController@index');

	Route::get('/nexmo/sendmsg', 'NexmoController@sendmessage');
	Route::get('/nexmo/sendgroupmsg', 'NexmoController@sendgroupmessage');
	Route::get('/inboundsms', 'NexmoController@inboundSMS');

	Route::get('/account', 'AccountController@index');



Route::auth();

Route::get('/home', 'HomeController@index');
