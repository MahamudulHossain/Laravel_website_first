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

//Admin services Managment
Route::get('/services', 'ServicesController@servicesIndex');
Route::get('/getServicesData', 'ServicesController@servicesData');
Route::post('/deleteServicesData', 'ServicesController@deleteServicesData');
Route::post('/getEachServiceData', 'ServicesController@eachServicesData');
Route::post('/updateServicesData', 'ServicesController@updateServicesData');
Route::post('/addServicesData', 'ServicesController@addServicesData');

//Admin services Managment
Route::get('/courses', 'CoursesController@coursesIndex');
Route::get('/getCoursesData', 'CoursesController@coursesData');
Route::post('/deleteCoursesData', 'CoursesController@deleteCoursesData');
Route::post('/getEachCourseData', 'CoursesController@eachCourseData');
Route::post('/updateCourseData', 'CoursesController@updateCourseData');
Route::post('/addCoursesData', 'CoursesController@addCoursesData');

//Admin services Managment
Route::get('/projects', 'ProjectsController@projectsIndex');
Route::get('/getProjectsData', 'ProjectsController@projectsData');
Route::post('/deleteProjectsData', 'ProjectsController@deleteProjectsData');
Route::post('/getEachProjectData', 'ProjectsController@eachProjectData');
Route::post('/updateProjectData', 'ProjectsController@updateProjectData');
Route::post('/addProjectsData', 'ProjectsController@addProjectsData');

// Admin contact Managment
Route::get('/contacts', 'ContactsController@contactsIndex');
Route::get('/getContactsData', 'ContactsController@contactsData');
Route::post('/deleteContactsData', 'ContactsController@deleteContactsData');


//Admin reviews Managment
Route::get('/reviews', 'ReviewsController@reviewsIndex');
Route::get('/getReviewsData', 'ReviewsController@reviewsData');
Route::post('/deleteReviewsData', 'ReviewsController@deleteReviewsData');
Route::post('/getEachReviewData', 'ReviewsController@eachReviewData');
Route::post('/updateReviewData', 'ReviewsController@updateReviewData');
Route::post('/addReviewsData', 'ReviewsController@addReviewsData');
