<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FontendController;
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
Route::get('/',[FontendController::class, 'index']);
Route::POST('/add_somethingelse',[FontendController::class, 'add_ste']);

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.home');
    });
    Route::group(['namespace' => 'App\Http\Controllers\admin'], function () {
        Route::resource('slide', 'SlideController');
        Route::resource('dept','DeptController');
        Route::resource('staff','StaffController');
        Route::resource('service','ServiceController');
        Route::resource('customer','CustomerController');
        Route::resource('feed_back','FeedBackController');
        Route::resource('user','UserController');
        Route::resource('blog','BlogController');
//        hien thi san pham cua 1 khach hang
        Route::get('/list-products/{id}', 'CustomerController@showProduct');
        Route::resource('detail','DetailController');
        Route::resource('product','ProductController');
        Route::post('/dept/search', 'DeptController@search');
        Route::post('/blog/search', 'BlogController@search');
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

        Route::delete('/fb/delete', 'FeedBackController@delete');
        Route::delete('/usrs/delete', 'UserController@destroys');
        Route::delete('/dts/delete', 'DetailController@delete');


//        End delte multi
        Route::post('/staff/search', 'StaffController@search');
        Route::post('/slide/search', 'SlideController@search');
        Route::post('/detail/search', 'DetailController@search');
    });
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
