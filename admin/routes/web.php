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

Route::get('/', 'HomeController@homeIndex');
Route::get('/visitordata', 'VisitorController@visitorIndex');
Route::get('/services', 'ServicesController@servicesIndex');
Route::get('/getServicesData', 'ServicesController@servicesData');
Route::post('/deleteServicesData', 'ServicesController@deleteServicesData');
Route::post('/getEachServiceData', 'ServicesController@eachServicesData');
