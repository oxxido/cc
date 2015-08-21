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
use App\Models;

Route::get('/test', function() {
    $data = array(
                'name' => "ger",
                'code' => "128",
        );
    $template = Models\Template::first();
    $msg = DbView::make($template)->field('html')->with($data)->render();
    print_r($msg);
});

Route::get('/', function() {
    return redirect('/home');
});

Route::get('creative', 'WelcomeController@creative');

Route::get('home', 			'HomeController@index');
Route::get('howitworks', 	'HomeController@howitworks');
Route::get('pricing', 		'HomeController@pricing');
Route::get('faqs', 			'HomeController@faqs');
Route::get('request', 		'HomeController@request');
Route::post('request', 		'HomeController@post_request');

Route::get('/resendEmail', 'Auth\AuthController@resendEmail');
Route::get('/activate/{code}', 'Auth\AuthController@activateAccount');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'location' => 'LocationController'
]);

// Dashboard

Route::get('/dashboard', function() {
    return redirect('/dashboard/business');
});

Route::get('/dashboard/searchAdmin', 	'DashboardController@searchAdmin');
Route::get('/dashboard/business',		'DashboardController@business');
Route::get('/dashboard/account', 		'DashboardController@account');
Route::get('/dashboard/widgets', 		'DashboardController@widgets');
Route::get('/dashboard/reports', 		'DashboardController@reports');
Route::get('/dashboard/help',    		'DashboardController@help');
Route::get('/dashboard/manageUsers',    'DashboardController@manageUsers');

//REST Resourse
Route::resource('crud/business', 'BusinessRestController');
Route::resource('crud/admin', 'AdminRestController');

Route::get('user/update', [
    'as' => 'user.update', 'uses' => 'UserController@update'
]);