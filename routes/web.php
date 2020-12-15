<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FontendController;
use App\Http\Controllers\admin\AdminController;
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
// Route::get('/', function () {
//     return view('home');
// });
use Illuminate\Support\Facades\File;

Route::get('/test', function(){
        return File::link(
                storage_path('app/public'), public_path('storage')
        );
});

Route::get('/',[FontendController::class, 'index']);
Route::post('/p/search',[FontendController::class, 'search']);
Route::get('/post/{slug}',[FontendController::class, 'viewPost']);
Route::get('/all-post', [FontendController::class, 'getPost']);
Route::get('/article',[FontendController::class, 'listPost']);
Route::post('/add_somethingelse',[FontendController::class, 'add_ste']);
Route::post('/add_hire',[FontendController::class, 'add_hire']);
Route::post('/add_candidate',[FontendController::class, 'add_candidate']);
Route::group(['prefix'=>'admin', 'middleware'=> 'auth' ],function () {

    Route::group(['namespace' => 'App\Http\Controllers\admin'], function () {
        Route::get('/',[AdminController::class,'index']);
        Route::group(['middleware'=>'type'], function(){
                Route::resource('slide', 'SlideController');
                Route::resource('dept','DeptController');
                Route::resource('staff','StaffController');
                Route::resource('service','ServiceController');
                Route::resource('customer','CustomerController');
                
                Route::resource('candidate','CandidateController');
                Route::resource('layout','LayoutController');
        });
        Route::resource('user','UserController');
        Route::resource('feed_back','FeedBackController');
        
        Route::resource('blog','BlogController');
        Route::resource('hire_page','HirePageController');
        
//        hien thi san pham cua 1 khach hang
        Route::get('/list-products/{id}', 'CustomerController@showProduct');
        Route::resource('detail','DetailController');
        Route::resource('product','ProductController');
        Route::post('/dept/search', 'DeptController@search');
        Route::post('/blog/search', 'BlogController@search');
        Route::get('/blog/status/view', 'BlogController@status');
        Route::post('bl/{id}', 'BlogController@accept');
        Route::post('bls/multi', 'BlogController@multiAccept');
//        View by product
        Route::get('/view-product/{id}', 'DetailController@byProduct');
        //view customer
        Route::get('/view-customer/{id}', 'CustomerController@viewCustomer');

        Route::get('/view-product/{id}', 'DetailController@byProduct');
//        Delete multi
        Route::delete('/dt/delete', 'DeptController@delete');
        Route::delete('/sa/delete', 'StaffController@delete');
        Route::delete('/se/delete', 'ServiceController@delete');
        Route::delete('/cu/delete', 'CustomerController@delete');
        Route::delete('/pr/delete', 'ProductController@delete');
        Route::delete('/bg/delete', 'BlogController@delete');
        Route::delete('/lo/delete', 'LayoutController@delete');

        Route::delete('/fb/delete', 'FeedBackController@delete');
        Route::delete('/usrs/delete', 'UserController@destroys');
        Route::delete('/dts/delete', 'DetailController@delete');
        Route::delete('/hp/delete', 'HirePageController@delete');
        Route::delete('/cn/delete', 'CandidateController@delete');

//        End delte multi
        Route::post('/staff/search', 'StaffController@search');
        Route::post('/slide/search', 'SlideController@search');
        Route::post('/detail/search', 'DetailController@search');
        Route::post('/user/search', 'UserController@search');
    });
});
