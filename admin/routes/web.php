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
Route::get('/Login','LoginController@loginIndex');
Route::post('/LoginData','LoginController@loginData');
Route::get('/LogOut','LoginController@logout');
Route::get('/', 'HomeController@homeIndex')->middleware('logInCheck');
Route::get('/visitordata', 'VisitorController@visitorIndex')->middleware('logInCheck');

//Admin services Managment
Route::get('/services', 'ServicesController@servicesIndex')->middleware('logInCheck');
Route::get('/getServicesData', 'ServicesController@servicesData')->middleware('logInCheck');
Route::post('/deleteServicesData', 'ServicesController@deleteServicesData')->middleware('logInCheck');
Route::post('/getEachServiceData', 'ServicesController@eachServicesData')->middleware('logInCheck');
Route::post('/updateServicesData', 'ServicesController@updateServicesData')->middleware('logInCheck');
Route::post('/addServicesData', 'ServicesController@addServicesData')->middleware('logInCheck');

//Admin services Managment
Route::get('/courses', 'CoursesController@coursesIndex')->middleware('logInCheck');
Route::get('/getCoursesData', 'CoursesController@coursesData')->middleware('logInCheck');
Route::post('/deleteCoursesData', 'CoursesController@deleteCoursesData')->middleware('logInCheck');
Route::post('/getEachCourseData', 'CoursesController@eachCourseData')->middleware('logInCheck');
Route::post('/updateCourseData', 'CoursesController@updateCourseData')->middleware('logInCheck');
Route::post('/addCoursesData', 'CoursesController@addCoursesData')->middleware('logInCheck');

//Admin services Managment
Route::get('/projects', 'ProjectsController@projectsIndex')->middleware('logInCheck');
Route::get('/getProjectsData', 'ProjectsController@projectsData')->middleware('logInCheck');
Route::post('/deleteProjectsData', 'ProjectsController@deleteProjectsData')->middleware('logInCheck');
Route::post('/getEachProjectData', 'ProjectsController@eachProjectData')->middleware('logInCheck');
Route::post('/updateProjectData', 'ProjectsController@updateProjectData')->middleware('logInCheck');
Route::post('/addProjectsData', 'ProjectsController@addProjectsData')->middleware('logInCheck');

// Admin contact Managment
Route::get('/contacts', 'ContactsController@contactsIndex')->middleware('logInCheck');
Route::get('/getContactsData', 'ContactsController@contactsData')->middleware('logInCheck');
Route::post('/deleteContactsData', 'ContactsController@deleteContactsData')->middleware('logInCheck');


//Admin reviews Managment
Route::get('/reviews', 'ReviewsController@reviewsIndex')->middleware('logInCheck');
Route::get('/getReviewsData', 'ReviewsController@reviewsData')->middleware('logInCheck');
Route::post('/deleteReviewsData', 'ReviewsController@deleteReviewsData')->middleware('logInCheck');
Route::post('/getEachReviewData', 'ReviewsController@eachReviewData')->middleware('logInCheck');
Route::post('/updateReviewData', 'ReviewsController@updateReviewData')->middleware('logInCheck');
Route::post('/addReviewsData', 'ReviewsController@addReviewsData')->middleware('logInCheck');


//Admin Images Upload Managment
Route::get('/image_upload', 'ImageUploadController@imageIndex')->middleware('logInCheck');
Route::post('/uploadPhoto', 'ImageUploadController@uploadPhoto')->middleware('logInCheck');
