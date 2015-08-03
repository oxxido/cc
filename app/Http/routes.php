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
use App\Business;

Route::get('/test', function() {
    $users = Business::all();
    print_r($users);
});

Route::get('/', function() {
    return redirect('/home');
});

Route::get('creative', 'WelcomeController@creative');

Route::get('home', 'HomeController@index');

Route::get('request', 'HomeController@request');

Route::post('request', 'HomeController@post_request');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/resendEmail', 'Auth\AuthController@resendEmail');

Route::get('/activate/{code}', 'Auth\AuthController@activateAccount');

// Dashboard
Route::get('/dashboard', 'DashboardController@index');

// Dashboard account
Route::get('/dashboard/account', 'DashboardController@account');
//resourse business
Route::resource('business', 'businessController');
