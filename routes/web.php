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
Route::get('/addserver', ['uses' => 'ServerController@showAddServer', 'as' => 'site.addserverShow']);
Route::post('/addserver', ['uses' => 'ServerController@addServer', 'as' => 'site.addserver']);

Auth::routes();

Route::group(['prefix' => 'dashboard','middleware' => ['auth']],function() {
//
    //INDEX
    Route::get('/',['uses' => 'Dashboard\IndexController@index','as' => 'dashboard.index']);
    Route::get('/servers', ['uses' => 'Dashboard\ServersController@index','as' => 'dashboard.servers']);
    Route::resource('/page', 'Dashboard\PagesController');
    Route::resource('/server', 'Dashboard\ServersController');
    Route::resource('/nomination', 'Dashboard\NominationsController');
    Route::resource('/application', 'Dashboard\ApplicationsController');
    Route::resource('/partner', 'Dashboard\PartnersController');
    Route::put('/application/{application}/accept', ['uses' => 'Dashboard\ApplicationsController@toAccept', 'as' => 'application.accept']);
    Route::delete('/application/{application}/accept', ['uses' => 'Dashboard\ApplicationsController@toDelete', 'as' => 'application.delete']);
    Route::get('/applications/{nomination}', ['uses' => 'Dashboard\NominationsController@showApplications', 'as' => 'nomination.applications']);
    Route::resource('/rate', 'Dashboard\RatesController');
    Route::resource('/chronicle', 'Dashboard\ChroniclesController');
    Route::post('/rate/sort', ['uses' => 'Dashboard\RatesController@sort','as' => 'rate.sort']);

    Route::group(['prefix' => 'image'],function() {
        Route::post('/page',['uses'=>'StorageController@UploadImage','as'=>'dashboard.page.store.image']);
    });

});

