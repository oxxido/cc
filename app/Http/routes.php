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

Route::get('home',  'HomeController@index');
Route::get('howitworks',   function(){ return view('howitworks'); });
Route::get('pricing',      function(){ return view('pricing'); });
Route::get('faqs',         function(){ return view('faqs'); });
Route::get('testimonials', function(){ return view('testimonials'); });
Route::get('userguide',    function(){ return view('userguide'); });
Route::get('terms',        function(){ return view('terms'); });

Route::get('contact',       function(){return view('contact');});
Route::post('contact',     'HomeController@post_contact');

Route::get('request', function(){return view('requestAnInvite');});
Route::post('request', 'HomeController@post_request');

Route::get('/resendEmail', 'Auth\AuthController@resendEmail');
Route::get('/activate/{code}', 'Auth\AuthController@activateAccount');

Route::controllers([
    'auth'      => 'Auth\AuthController',
    'password'  => 'Auth\PasswordController',
    'location'  => 'LocationController',
    'dashbiz'   => 'DashboardBusinessController',
    'dashowner' => 'DashboardOwnerController'
]);

// Dashboard

Route::get('/dashboard',             'DashboardController@index');
Route::get('/dashboard/account',     'DashboardController@account');
Route::get('/dashboard/widgets',     'DashboardController@widgets');
Route::get('/dashboard/reports',     'DashboardController@reports');
Route::get('/dashboard/help',        'DashboardController@help');

//REST Resourse
Route::resource('crud/business', 'BusinessRestController');
Route::resource('crud/admin', 'AdminRestController');

Route::get('user/update', [
    'as' => 'user.update', 'uses' => 'UserController@update'
]);