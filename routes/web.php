<?php

use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Product;
use Illuminate\Support\Facades\Route;
use App\Category;
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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'Dashboard'], function () {
Route::match(['get', 'post'], '/admin/login','AdminController@login');
Route::group(['middleware'=>['admin']], function(){
        /*
        |--------------------------------------------------------------------------
        | Dashboard and Admin Controller Route Starts
        |--------------------------------------------------------------------------
        */

            Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');


            Route::get('/logout', 'AdminController@logout');
            Route::get('/admin/settings', 'AdminController@settings');
            Route::post('/admin/check-current-pwd', 'AdminController@checkCurrentPassword');
            Route::post('/admin/update-current-pwd', 'AdminController@updateCurrentPwd');
            Route::match(['get', 'post'],'/admin/update-details', 'AdminController@updateAdminDetails');

        /*
        |--------------------------------------------------------------------------
        | Dashboard and Admin Controller Route End
        |--------------------------------------------------------------------------
        */
        /*
        |--------------------------------------------------------------------------
        | Role Controller Route Starts
        |--------------------------------------------------------------------------
        */

            Route::get('/role/management', 'RoleController@index')->name('management.index');
            Route::post('/role/management', 'RoleController@addRole')->name('management.index');
            Route::get('/admin/delete-role/{id}', 'RoleController@deleteRole')->name('role.delete');
            Route::get('/role/user', 'RoleController@userDetails')->name('management.user');
            Route::post('/role/assign', 'RoleController@assignRole')->name('management.assig.role');
            Route::get('/role/edit/{id}', 'RoleController@editRole')->name('management.edit');
            Route::post('/role/change', 'RoleController@changePermission')->name('management.changePermission');
            Route::post('/user/create', 'AdminController@createUser')->name('management.createUser');
            Route::get('/admin/delete-user/{id}', 'RoleController@deleteUser')->name('management.deleteUser');
            Route::post('/update-admin-status', 'AdminController@updateAdmintStatus');

        /*
        |--------------------------------------------------------------------------
        | Role Controller Route End
        |--------------------------------------------------------------------------
        */

        Route::prefix('/admin')->group(function(){
            Route::get('section','SectionController@sections');
            Route::match(['get', 'post'], '/add-edit-section/{id?}', 'SectionController@addEditSection');
            Route::post('/update-section-status','SectionController@updateSectionStatus');
            Route::get('delete-section/{id}', 'SectionController@deleteSection');



        /*
        |--------------------------------------------------------------------------
        | Sub Section Controller Route Start
        |--------------------------------------------------------------------------
        */
            Route::get('/subSection', 'SubSectionController@showSubSection');
            Route::post('/add-subSection', 'SubSectionController@addSubSection');
            Route::post('/update-subSection-status', 'SubSectionController@updateSubSectionStatus');
            Route::get('delete-subSection/{id}', 'SubSectionController@deleteSubSection');
        });

        /*
        |--------------------------------------------------------------------------
        | Sub Section Controller Route End
        |--------------------------------------------------------------------------
        */


    });
});


/*
|--------------------------------------------------------------------------
| Frontend Routes End
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
