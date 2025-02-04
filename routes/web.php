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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/login',[App\Http\Controllers\AdminUserBackendController::class,'login'])->name('login');
Route::post('/login_backend',[App\Http\Controllers\AdminUserBackendController::class,'login_backend']);



Route::group(['middleware' => ['auth:admin']],function(){
    Route::get('/',[App\Http\Controllers\AdminUserBackendController::class,'users']);
    Route::get('/backend',[App\Http\Controllers\AdminUserBackendController::class,'users']);
 //admin
 Route::get('admin',[App\Http\Controllers\AdminUserBackendController::class,'admin']);
 Route::get('admin_destroy/{id}',[App\Http\Controllers\AdminUserBackendController::class,'admin_destroy']);
 Route::get('admin_add',[App\Http\Controllers\AdminUserBackendController::class,'admin_add']);
 Route::post('admin_store',[App\Http\Controllers\AdminUserBackendController::class,'admin_store']);
 Route::get('admin_edit/{id}',[App\Http\Controllers\AdminUserBackendController::class,'admin_edit']);
 Route::post('admin_update/{id}',[App\Http\Controllers\AdminUserBackendController::class,'admin_update']);
 Route::post('admin_open_close',[App\Http\Controllers\AdminUserBackendController::class,'admin_open_close']);
 //admin

  //userss
  Route::post('users_store_form_in',[App\Http\Controllers\AdminUserBackendController::class,'users_store_form_in']);

  
  Route::post('users_update_date',[App\Http\Controllers\AdminUserBackendController::class,'users_update_date']);

  Route::get('users',[App\Http\Controllers\AdminUserBackendController::class,'users']);
  Route::get('users_destroy/{id}',[App\Http\Controllers\AdminUserBackendController::class,'users_destroy']);
  Route::get('users_add',[App\Http\Controllers\AdminUserBackendController::class,'users_add']);
  Route::get('users_add_many',[App\Http\Controllers\AdminUserBackendController::class,'users_add_many']);
  Route::post('users_store',[App\Http\Controllers\AdminUserBackendController::class,'users_store']);
  Route::post('users_store_many',[App\Http\Controllers\AdminUserBackendController::class,'users_store_many']);
  Route::get('users_edit/{id}',[App\Http\Controllers\AdminUserBackendController::class,'users_edit']);
  Route::post('users_update/{id}',[App\Http\Controllers\AdminUserBackendController::class,'users_update']);
  Route::post('users_open_close',[App\Http\Controllers\AdminUserBackendController::class,'users_open_close']);

  Route::post('users_in_in_open_close',[App\Http\Controllers\AdminUserBackendController::class,'users_in_in_open_close']);
  Route::post('add_user_in_in',[App\Http\Controllers\AdminUserBackendController::class,'add_user_in_in']);
  Route::get('users_in_in_destroy/{id}',[App\Http\Controllers\AdminUserBackendController::class,'users_in_in_destroy']);
  //users

  Route::post('autoCreateUsersInIn',[App\Http\Controllers\AdminUserBackendController::class,'autoCreateUsersInIn']);
    //users
    Route::get('users_in',[App\Http\Controllers\AdminUserBackendController::class,'users_in']);
    Route::get('users_in_destroy/{id}',[App\Http\Controllers\AdminUserBackendController::class,'users_in_destroy']);
    Route::get('users_in_add',[App\Http\Controllers\AdminUserBackendController::class,'users_in_add']);
    Route::post('users_in_store',[App\Http\Controllers\AdminUserBackendController::class,'users_in_store']);
    Route::get('users_in_edit/{id}',[App\Http\Controllers\AdminUserBackendController::class,'users_in_edit']);
    Route::post('users_in_update/{id}',[App\Http\Controllers\AdminUserBackendController::class,'users_in_update']);
    Route::post('users_in_open_close',[App\Http\Controllers\AdminUserBackendController::class,'users_in_open_close']);
    //users





  Route::get('/logout',[App\Http\Controllers\AdminUserBackendController::class,'logout'])->name('logout');
    Route::get('/register',[App\Http\Controllers\AdminUserBackendController::class,'register'])->name('register');
    Route::get('/verify',[App\Http\Controllers\AdminUserBackendController::class,'verify'])->name('verify');



});
