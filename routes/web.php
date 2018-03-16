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


Route::get('/', ['uses' => 'IndexController@index', 'as' => 'site.index']);
Route::get('/page/{page}', ['uses' => 'PagesController@show', 'as' => 'site.page.show']);
Route::get('/addserver', ['uses' => 'ServerController@create', 'as' => 'site.server.create']);
Route::get('/server/{server}', ['uses' => 'ServerController@show', 'as' => 'site.server.show']);
Route::post('/addserver', ['uses' => 'ServerController@store', 'as' => 'site.server.store']);
Route::post('/application/{nomination}', ['uses' => 'ApplicationsController@store', 'as' => 'site.application.store']);

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->post('register', 'Auth\RegisterController@register');
//
//// Password Reset Routes...
//$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['prefix' => 'dashboard','middleware' => ['auth']],function() {
    Route::get('/',['uses' => 'Dashboard\IndexController@index','as' => 'dashboard.index']);
    Route::get('/servers/{type?}', ['uses' => 'Dashboard\ServersController@index','as' => 'dashboard.servers']);
    Route::resource('/page', 'Dashboard\PagesController');
    Route::resource('/server', 'Dashboard\ServersController');
    Route::resource('/nomination', 'Dashboard\NominationsController');
    Route::resource('/application', 'Dashboard\ApplicationsController');
    Route::resource('/partner', 'Dashboard\PartnersController');
    Route::resource('/ad', 'Dashboard\AdsController');
    Route::resource('/rate', 'Dashboard\RatesController');
    Route::resource('/chronicle', 'Dashboard\ChroniclesController');
    Route::post('/rate/sort', ['uses' => 'Dashboard\RatesController@sort','as' => 'rate.sort']);
    Route::post('/chronicle/sort', ['uses' => 'Dashboard\ChroniclesController@sort','as' => 'chronicle.sort']);
    Route::get('/settings/',['uses' => 'Dashboard\SettingsController@edit', 'as' => 'settings']);
    Route::put('/settings/',['uses' => 'Dashboard\SettingsController@update', 'as' => 'settings.update']);
    Route::put('/application/{application}/accept', ['uses' => 'Dashboard\ApplicationsController@toAccept', 'as' => 'application.accept']);
    Route::delete('/application/{application}/accept', ['uses' => 'Dashboard\ApplicationsController@toDelete', 'as' => 'application.delete']);
    Route::get('/applications/{nomination}', ['uses' => 'Dashboard\NominationsController@showApplications', 'as' => 'nomination.applications']);

    Route::group(['prefix' => 'action'],function() {
        Route::put('/{server}/active',['uses'=>'Dashboard\ServersController@toActive','as'=>'server.active']);
        Route::get('/vk/{server}/{partner?}',['uses'=>'Dashboard\ServersController@toPost','as'=>'server.post']);
    });

    Route::group(['prefix' => 'image'],function() {
        Route::post('/page',['uses'=>'StorageController@UploadImage','as'=>'dashboard.page.store.image']);
        Route::post('/post',['uses'=>'StorageController@UploadImage','as'=>'dashboard.page.store.image']);
    });

});

