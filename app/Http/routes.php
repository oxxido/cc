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

Route::get('/test', function () {
    $data     = [
        'name' => "ger",
        'code' => "128",
    ];
    $template = Models\Template::first();
    $msg      = DbView::make($template)->field('html')->with($data)->render();
    print_r($msg);
});

Route::get('/', function () {
    return redirect('/home');
});
Route::get('home', function () {
    return view('home.index');
});
Route::get('howitworks', function () {
    return view('home.howitworks');
});
Route::get('pricing', function () {
    return view('home.pricing');
});
Route::get('faqs', function () {
    return view('home.faqs');
});
Route::get('testimonials', function () {
    return view('home.testimonials');
});
Route::get('userguide', function () {
    return view('home.userguide');
});
Route::get('terms', function () {
    return view('home.terms');
});
Route::get('privacy', function () {
    return view('home.privacy');
});

Route::get('contact', function () {
    return view('home.contact');
});
Route::post('contact', 'HomeController@send');
Route::get('invite', function () {
    return view('home.invite');
});
Route::post('invite', 'HomeController@send');

Route::controllers([
    'auth'      => 'Auth\AuthController',
    'password'  => 'Auth\PasswordController',
    'location'  => 'LocationController',
    'dashboard' => 'DashboardController',
    'dashowner' => 'DashboardOwnerController',
    'dashadmin' => 'DashboardAdminController',
    'widget'    => 'WidgetController'
]);

//REST Resourse
Route::post('crud/business/csv', 'BusinessRestController@csv');
Route::resource('crud/business', 'BusinessRestController');
Route::resource('crud/admin', 'AdminRestController');

Route::resource('crud/link', 'LinkRestController');

Route::post('user/update', [
    'as'   => 'user.update',
    'uses' => 'UserController@update'
]);
Route::get('reports', 'ReportController@index');
Route::group(['middleware' => ['auth','business.rights']], function () {

    // Routes for Dashboard Business Controller
    Route::get('dashbiz/{biz}', ['as' => 'business.dashboard', 'uses' => 'DashboardBusinessController@getIndex']);
    Route::get('dashbiz/{biz}/email', ['as' => 'business.dashboard.email', 'uses' => 'DashboardBusinessController@getEmail']);
    Route::post('dashbiz/{biz}/email', ['as' => 'business.dashboard.email', 'uses' => 'DashboardBusinessController@postEmail']);
    Route::get('dashbiz/{biz}/feedback', ['as' => 'business.dashboard.feedback', 'uses' => 'DashboardBusinessController@getFeedback']);
    Route::post('dashbiz/{biz}/feedback', ['as' => 'business.dashboard.feedback', 'uses' => 'DashboardBusinessController@postFeedback']);
    Route::post('dashbiz/{biz}/upload', ['as' => 'business.dashboard.feedback.upload', 'uses' => 'DashboardBusinessController@postUpload']);
    Route::get('dashbiz/{biz}/gallery', ['as' => 'business.dashboard.feedback.gallery', 'uses' => 'DashboardBusinessController@getGallery']);
    Route::post('dashbiz/{biz}/image', ['as' => 'business.dashboard.feedback.image', 'uses' => 'DashboardBusinessController@postImage']);
    Route::get('dashbiz/{biz}/testimonial', ['as' => 'business.dashboard.testimonial', 'uses' => 'DashboardBusinessController@getTestimonial']);
    Route::post('dashbiz/{biz}/testimonial', ['as' => 'business.dashboard.testimonial', 'uses' => 'DashboardBusinessController@postTestimonial']);
    Route::get('dashbiz/{biz}/notification', ['as' => 'business.dashboard.notification', 'uses' => 'DashboardBusinessController@getNotification']);
    Route::post('dashbiz/{biz}/notification', ['as' => 'business.dashboard.notification', 'uses' => 'DashboardBusinessController@postNotification']);

    // Routes for Business Links CRUD
    Route::get('dashbiz/{biz}/links', ['as' => 'business.dashboard.links', 'uses' => 'DashboardBusinessController@getLinks']);
    Route::get('business/{biz}/links', ['as' => 'business.links', 'uses' => 'LinkRestController@index']);
    Route::post('business/{biz}/link', ['as' => 'business.link.store', 'uses' => 'LinkRestController@store']);
    Route::delete('business/{biz}/link/{link}', ['as' => 'business.link.destroy', 'uses' => 'LinkRestController@destroy']);
    Route::get('business/{biz}/link/{link}/edit', ['as' => 'business.link.edit', 'uses' => 'LinkRestController@edit']);
    Route::put('business/{biz}/link/{link}', ['as' => 'business.link.update', 'uses' => 'LinkRestController@update']);

    // Routes for Business Comenters CRUD
    Route::get('business/{biz}/customers', ['as' => 'business.commenters', 'uses' => 'CommenterRestController@index']);
    Route::post('business/{biz}/customers/import', ['as' => 'business.commenters.import', 'uses' => 'CommenterRestController@import']);
    Route::get('business/{biz}/customers/assign', ['as' => 'business.commenters.check', 'uses' => 'CommenterRestController@check']);
    Route::put('business/{biz}/customers/assign', ['as' => 'business.commenters.assign', 'uses' => 'CommenterRestController@assign']);
    Route::get('business/{biz}/customer/{commenter}/pause', ['as' => 'business.commenter.pause', 'uses' => 'CommenterRestController@pause']);
    Route::get('business/{biz}/customer/{commenter}/sendrequest', ['as' => 'business.commenter.sendrequest', 'uses' => 'CommenterRestController@sendrequest']);
    Route::post('business/{biz}/customer', ['as' => 'business.commenter.store', 'uses' => 'CommenterRestController@store']);
    Route::get('business/{biz}/customer/create', ['as' => 'business.commenter.create', 'uses' => 'CommenterRestController@create']);
    Route::delete('business/{biz}/customer/{commenter}/destroy', ['as' => 'business.commenter.destroy', 'uses' => 'CommenterRestController@destroy']);
});
