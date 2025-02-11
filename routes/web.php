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

 Route::get('his_created',[App\Http\Controllers\AdminUserBackendController::class,'his_created']);

  //userss
  Route::post('users_store_form_in',[App\Http\Controllers\AdminUserBackendController::class,'users_store_form_in']);

  
  Route::post('users_update_date',[App\Http\Controllers\AdminUserBackendController::class,'users_update_date']);

  
  Route::get('users_edit_status_check_admin/{id}',[App\Http\Controllers\AdminUserBackendController::class,'users_edit_status_check_admin']);

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

    //coupon
    Route::get('coupon',[App\Http\Controllers\CouponBackendController::class,'coupon']);
    Route::get('coupon_destroy/{id}',[App\Http\Controllers\CouponBackendController::class,'coupon_destroy']);
    Route::get('coupon_add',[App\Http\Controllers\CouponBackendController::class,'coupon_add']);
    Route::post('coupon_store',[App\Http\Controllers\CouponBackendController::class,'coupon_store']);
    Route::get('coupon_edit/{id}',[App\Http\Controllers\CouponBackendController::class,'coupon_edit']);
    Route::post('coupon_update/{id}',[App\Http\Controllers\CouponBackendController::class,'coupon_update']);
    Route::post('coupon_open_close',[App\Http\Controllers\CouponBackendController::class,'coupon_open_close']);
    //coupon

    //package
    Route::get('package',[App\Http\Controllers\PackageBackendController::class,'package']);
    Route::get('package_destroy/{id}',[App\Http\Controllers\PackageBackendController::class,'package_destroy']);
    Route::get('package_add',[App\Http\Controllers\PackageBackendController::class,'package_add']);
    Route::post('package_store',[App\Http\Controllers\PackageBackendController::class,'package_store']);
    Route::get('package_edit/{id}',[App\Http\Controllers\PackageBackendController::class,'package_edit']);
    Route::post('package_update/{id}',[App\Http\Controllers\PackageBackendController::class,'package_update']);
    Route::post('package_open_close',[App\Http\Controllers\PackageBackendController::class,'package_open_close']);
    //package

    //subpackage
    Route::get('subpackage',[App\Http\Controllers\PackageSubBackendController::class,'subpackage']);
    Route::get('subpackage_destroy/{id}',[App\Http\Controllers\PackageSubBackendController::class,'subpackage_destroy']);
    Route::get('subpackage_add',[App\Http\Controllers\PackageSubBackendController::class,'subpackage_add']);
    Route::post('subpackage_store',[App\Http\Controllers\PackageSubBackendController::class,'subpackage_store']);
    Route::get('subpackage_edit/{id}',[App\Http\Controllers\PackageSubBackendController::class,'subpackage_edit']);
    Route::post('subpackage_update/{id}',[App\Http\Controllers\PackageSubBackendController::class,'subpackage_update']);
    Route::post('subpackage_open_close',[App\Http\Controllers\PackageSubBackendController::class,'subpackage_open_close']);
    //subpackage

    //reward
    Route::get('reward',[App\Http\Controllers\RewardBackendController::class,'reward']);
    Route::get('reward_destroy/{id}',[App\Http\Controllers\RewardBackendController::class,'reward_destroy']);
    Route::get('reward_add',[App\Http\Controllers\RewardBackendController::class,'reward_add']);
    Route::post('reward_store',[App\Http\Controllers\RewardBackendController::class,'reward_store']);
    Route::get('reward_edit/{id}',[App\Http\Controllers\RewardBackendController::class,'reward_edit']);
    Route::post('reward_update/{id}',[App\Http\Controllers\RewardBackendController::class,'reward_update']);
    Route::post('reward_open_close',[App\Http\Controllers\RewardBackendController::class,'reward_open_close']);
    //reward

    //marking
    Route::get('marking',[App\Http\Controllers\MarkingBackendController::class,'marking']);
    Route::get('marking_destroy/{id}',[App\Http\Controllers\MarkingBackendController::class,'marking_destroy']);
    Route::get('marking_add',[App\Http\Controllers\MarkingBackendController::class,'marking_add']);
    Route::post('marking_store',[App\Http\Controllers\MarkingBackendController::class,'marking_store']);
    Route::get('marking_edit/{id}',[App\Http\Controllers\MarkingBackendController::class,'marking_edit']);
    Route::post('marking_update/{id}',[App\Http\Controllers\MarkingBackendController::class,'marking_update']);
    Route::post('marking_open_close',[App\Http\Controllers\MarkingBackendController::class,'marking_open_close']);
    //marking

  Route::get('/logout',[App\Http\Controllers\AdminUserBackendController::class,'logout'])->name('logout');
    Route::get('/register',[App\Http\Controllers\AdminUserBackendController::class,'register'])->name('register');
    Route::get('/verify',[App\Http\Controllers\AdminUserBackendController::class,'verify'])->name('verify');



});


Route::get('frontlogin',function(){
  return view('frontend.login');
})->name('frontend.login');

Route::get('netflix',[App\Http\Controllers\UserFrontendController::class,'nFYtPackage'])->name('frontend.netflix');

Route::get('youtube',[App\Http\Controllers\UserFrontendController::class,'nFYtPackage'])->name('frontend.youtube');

Route::get('profile',function(){
  return view('frontend.profile');
})->name('frontend.profile');

Route::get('rewards',[App\Http\Controllers\UserFrontendController::class,'rewardsRead'])->name('frontend.rewards');

Route::get('thankyou',function(){
  return view('frontend.thankyou');
})->name('frontend.thankyou');

