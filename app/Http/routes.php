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

Route::get('/',             function(){return redirect('/home');});
Route::get('home',          function(){return view('home.index');});
Route::get('howitworks',    function(){return view('home.howitworks');});
Route::get('pricing',       function(){return view('home.pricing');});
Route::get('faqs',          function(){return view('home.faqs');});
Route::get('testimonials',  function(){return view('home.testimonials');});
Route::get('userguide',     function(){return view('home.userguide');});
Route::get('terms',         function(){return view('home.terms');});

Route::get('contact',   function(){return view('home.contact');});
Route::post('contact',  'HomeController@send');
Route::get('invite',    function(){return view('home.invite');});
Route::post('invite',   'HomeController@send');

Route::controllers([
    'auth'      => 'Auth\AuthController',
    'password'  => 'Auth\PasswordController',
    'location'  => 'LocationController',
    'dashboard' => 'DashboardController',
    'dashbiz'   => 'DashboardBusinessController',
    'dashowner' => 'DashboardOwnerController',
    'widget'    => 'WidgetController'
]);


//REST Resourse
Route::resource('crud/business', 'BusinessRestController');
Route::resource('crud/admin', 'AdminRestController');

Route::resource('crud/link', 'LinkRestController');

Route::post('user/update', [
    'as' => 'user.update', 'uses' => 'UserController@update'
]);