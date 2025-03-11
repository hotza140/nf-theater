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




// ------------------------

Route::get('/',function(){
  return view('frontend.login');
})->name('frontend.login');

Route::get('frontlogin',function(){
  return view('frontend.login');
})->name('frontend.login');

Route::get('logoutfrontend',[App\Http\Controllers\UserFrontendController::class, 'logoutfrontend'])->name('logoutfrontend');

Route::post('login_frontend',[App\Http\Controllers\UserFrontendController::class, 'login_frontend'])->name('login_frontend');

Route::group(['middleware' => ['users']],function(){

    Route::get('netflix',[App\Http\Controllers\UserFrontendController::class,'nFYtPackage'])->name('frontend.netflix');

    Route::get('youtube',[App\Http\Controllers\UserFrontendController::class,'nFYtPackage'])->name('frontend.youtube');

    Route::get('profile',[App\Http\Controllers\UserFrontendController::class,'profileRdSh'])->name('frontend.profile');

    Route::get('rewards',[App\Http\Controllers\UserFrontendController::class,'rewardsRead'])->name('frontend.rewards');

    Route::get('thankyou',function(){
      return view('frontend.thankyou');
    })->name('frontend.thankyou');

    Route::get('RewardUserLog_store',[App\Http\Controllers\UserFrontendController::class,'RewardUserLog_store'])->name('frontend.RewardUserLog_store');

    // SendOrderPackage Youtube & Netflix...
    Route::post('SendOrderPackage',[App\Http\Controllers\UserFrontendController::class,'SendOrderPackage'])->name('frontend.SendOrderPackage');

    // Order Package Youtube & Netflix...
    Route::post('SaveOrderPackage',[App\Http\Controllers\UserFrontendController::class,'SaveOrderPackage'])->name('frontend.SaveOrderPackage');

    // upCheckQR SlipOK....& Save data slip.....
    Route::post('upCheckQR',[App\Http\Controllers\UserFrontendController::class,'upCheckQR'])->name('frontend.upCheckQR');

    // afterSaveOrderPackage ....
    Route::post('afterSaveOrderPackage',[App\Http\Controllers\UserFrontendController::class,'afterSaveOrderPackage'])->name('frontend.afterSaveOrderPackage');

    Route::get('SendMailSMTPT1',[App\Http\Controllers\UserFrontendController::class,'SendMailSMTPT1'])->name('frontend.SendMailSMTPT1');
    
});

// image Slip Base64
Route::post('getimgSlipBase64',[App\Http\Controllers\UserFrontendController::class,'getimgSlipBase64'])->name('frontend.getimgSlipBase64');

// ------------------------



Route::group(['middleware' => ['admin']],function(){
    Route::get('/backend',[App\Http\Controllers\AdminUserBackendController::class,'users_all']);
 //admin
 Route::get('admin',[App\Http\Controllers\AdminUserBackendController::class,'admin']);
 Route::get('admin_destroy/{id}',[App\Http\Controllers\AdminUserBackendController::class,'admin_destroy']);
 Route::get('admin_add',[App\Http\Controllers\AdminUserBackendController::class,'admin_add']);
 Route::post('admin_store',[App\Http\Controllers\AdminUserBackendController::class,'admin_store']);
 Route::get('admin_edit/{id}',[App\Http\Controllers\AdminUserBackendController::class,'admin_edit']);
 Route::post('admin_update/{id}',[App\Http\Controllers\AdminUserBackendController::class,'admin_update']);
 Route::post('admin_open_close',[App\Http\Controllers\AdminUserBackendController::class,'admin_open_close']);
 //admin


  //country
  Route::get('country',[App\Http\Controllers\AdminUserBackendController::class,'country']);
  Route::get('country_destroy/{id}',[App\Http\Controllers\AdminUserBackendController::class,'country_destroy']);
  Route::get('country_add',[App\Http\Controllers\AdminUserBackendController::class,'country_add']);
  Route::post('country_store',[App\Http\Controllers\AdminUserBackendController::class,'country_store']);
  Route::get('country_edit/{id}',[App\Http\Controllers\AdminUserBackendController::class,'country_edit']);
  Route::post('country_update/{id}',[App\Http\Controllers\AdminUserBackendController::class,'country_update']);
  //country
 


//  NETFLIX///
Route::get('users_status_edit/{id}',[App\Http\Controllers\AdminUserBackendController::class,'users_status_edit']);

 Route::get('his_created',[App\Http\Controllers\AdminUserBackendController::class,'his_created']);

 Route::get('users_all',[App\Http\Controllers\AdminUserBackendController::class,'users_all']);

 Route::post('users_update_date',[App\Http\Controllers\AdminUserBackendController::class,'users_update_date']);
  //userss
  Route::post('users_store_form_in',[App\Http\Controllers\AdminUserBackendController::class,'users_store_form_in']);
  Route::post('updateStatusOnExit',[App\Http\Controllers\AdminUserBackendController::class,'updateStatusOnExit']);
  Route::post('/update-status-on-exit', [App\Http\Controllers\AdminUserBackendController::class,'updateStatusOnExit'])->name('updateStatusOnExit');

  
  Route::get('users_edit_status_check_admin/{id}',[App\Http\Controllers\AdminUserBackendController::class,'users_edit_status_check_admin']);
  Route::get('users_edit_status_check_admin_all/{id}',[App\Http\Controllers\AdminUserBackendController::class,'users_edit_status_check_admin_all']);

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

  Route::get('change_user/{id}',[App\Http\Controllers\AdminUserBackendController::class,'change_user']);

  Route::post('autoCreateUsersInIn',[App\Http\Controllers\AdminUserBackendController::class,'autoCreateUsersInIn']);
  Route::post('autoCreateUsersInIn_aaa',[App\Http\Controllers\AdminUserBackendController::class,'autoCreateUsersInIn_aaa']);
    //users
    Route::get('users_in',[App\Http\Controllers\AdminUserBackendController::class,'users_in']);
    Route::get('users_in_destroy/{id}',[App\Http\Controllers\AdminUserBackendController::class,'users_in_destroy']);
    Route::get('users_in_add',[App\Http\Controllers\AdminUserBackendController::class,'users_in_add']);
    Route::post('users_in_store',[App\Http\Controllers\AdminUserBackendController::class,'users_in_store']);
    Route::get('users_in_edit/{id}',[App\Http\Controllers\AdminUserBackendController::class,'users_in_edit']);
    Route::post('users_in_update/{id}',[App\Http\Controllers\AdminUserBackendController::class,'users_in_update']);
    Route::post('users_in_open_close',[App\Http\Controllers\AdminUserBackendController::class,'users_in_open_close']);
    //users
//  NETFLIX///





//  YOUTUBE///
Route::get('y_users_status_edit/{id}',[App\Http\Controllers\YoutubeBackendController::class,'y_users_status_edit']);

    Route::get('y_his_created',[App\Http\Controllers\YoutubeBackendController::class,'his_created']);

    Route::get('y_users_all',[App\Http\Controllers\YoutubeBackendController::class,'users_all']);
   
    Route::post('y_users_update_date',[App\Http\Controllers\YoutubeBackendController::class,'users_update_date']);
     //userss
     Route::post('y_users_store_form_in',[App\Http\Controllers\YoutubeBackendController::class,'users_store_form_in']);
     Route::post('y_updateStatusOnExit',[App\Http\Controllers\YoutubeBackendController::class,'updateStatusOnExit']);
     Route::post('/y_update-status-on-exit', [App\Http\Controllers\YoutubeBackendController::class,'updateStatusOnExit'])->name('updateStatusOnExit');
   
     
     Route::get('y_users_edit_status_check_admin/{id}',[App\Http\Controllers\YoutubeBackendController::class,'users_edit_status_check_admin']);
     Route::get('y_users_edit_status_check_admin_all/{id}',[App\Http\Controllers\YoutubeBackendController::class,'users_edit_status_check_admin_all']);
   
     Route::get('y_users',[App\Http\Controllers\YoutubeBackendController::class,'users']);
     Route::get('y_users_destroy/{id}',[App\Http\Controllers\YoutubeBackendController::class,'users_destroy']);
     Route::get('y_users_add',[App\Http\Controllers\YoutubeBackendController::class,'users_add']);
     Route::get('y_users_add_many',[App\Http\Controllers\YoutubeBackendController::class,'users_add_many']);
     Route::post('y_users_store',[App\Http\Controllers\YoutubeBackendController::class,'users_store']);
     Route::post('y_users_store_many',[App\Http\Controllers\YoutubeBackendController::class,'users_store_many']);
     Route::get('y_users_edit/{id}',[App\Http\Controllers\YoutubeBackendController::class,'users_edit']);
     Route::post('y_users_update/{id}',[App\Http\Controllers\YoutubeBackendController::class,'users_update']);
     Route::post('y_users_open_close',[App\Http\Controllers\YoutubeBackendController::class,'users_open_close']);
   
     Route::post('y_users_in_in_open_close',[App\Http\Controllers\YoutubeBackendController::class,'users_in_in_open_close']);
     Route::post('y_add_user_in_in',[App\Http\Controllers\YoutubeBackendController::class,'add_user_in_in']);
     Route::get('y_users_in_in_destroy/{id}',[App\Http\Controllers\YoutubeBackendController::class,'users_in_in_destroy']);
     //users
   
     Route::get('y_change_user/{id}',[App\Http\Controllers\YoutubeBackendController::class,'change_user']);
   
     Route::post('y_autoCreateUsersInIn',[App\Http\Controllers\YoutubeBackendController::class,'autoCreateUsersInIn']);
     Route::post('y_autoCreateUsersInIn_aaa',[App\Http\Controllers\YoutubeBackendController::class,'autoCreateUsersInIn_aaa']);
       //users
       Route::get('y_users_in',[App\Http\Controllers\YoutubeBackendController::class,'users_in']);
       Route::get('y_users_in_destroy/{id}',[App\Http\Controllers\YoutubeBackendController::class,'users_in_destroy']);
       Route::get('y_users_in_add',[App\Http\Controllers\YoutubeBackendController::class,'users_in_add']);
       Route::post('y_users_in_store',[App\Http\Controllers\YoutubeBackendController::class,'users_in_store']);
       Route::get('y_users_in_edit/{id}',[App\Http\Controllers\YoutubeBackendController::class,'users_in_edit']);
       Route::post('y_users_in_update/{id}',[App\Http\Controllers\YoutubeBackendController::class,'users_in_update']);
       Route::post('y_users_in_open_close',[App\Http\Controllers\YoutubeBackendController::class,'users_in_open_close']);
       //users

//  YOUTUBE///

    // //coupon
    // Route::get('coupon',[App\Http\Controllers\CouponBackendController::class,'coupon']);
    // Route::get('coupon_destroy/{id}',[App\Http\Controllers\CouponBackendController::class,'coupon_destroy']);
    // Route::get('coupon_add',[App\Http\Controllers\CouponBackendController::class,'coupon_add']);
    // Route::post('coupon_store',[App\Http\Controllers\CouponBackendController::class,'coupon_store']);
    // Route::get('coupon_edit/{id}',[App\Http\Controllers\CouponBackendController::class,'coupon_edit']);
    // Route::post('coupon_update/{id}',[App\Http\Controllers\CouponBackendController::class,'coupon_update']);
    // Route::post('coupon_open_close',[App\Http\Controllers\CouponBackendController::class,'coupon_open_close']);
    // //coupon

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

    //gift
    Route::get('gift',[App\Http\Controllers\GiftBackendController::class,'gift']);
    Route::get('gift_destroy/{id}',[App\Http\Controllers\GiftBackendController::class,'gift_destroy']);
    Route::get('gift_add',[App\Http\Controllers\GiftBackendController::class,'gift_add']);
    Route::post('gift_store',[App\Http\Controllers\GiftBackendController::class,'gift_store']);
    Route::get('gift_edit/{id}',[App\Http\Controllers\GiftBackendController::class,'gift_edit']);
    Route::post('gift_update/{id}',[App\Http\Controllers\GiftBackendController::class,'gift_update']);
    Route::post('gift_open_close',[App\Http\Controllers\GiftBackendController::class,'gift_open_close']);
    //gift

    //gift
    Route::get('orderpaypackage',[App\Http\Controllers\OrderPayPackageController::class,'orderpaypackage']);
    Route::get('orderpaypackage_destroy/{id}',[App\Http\Controllers\OrderPayPackageController::class,'orderpaypackage_destroy']);
    Route::get('orderpaypackage_add',[App\Http\Controllers\OrderPayPackageController::class,'orderpaypackage_add']);
    Route::post('orderpaypackage_store',[App\Http\Controllers\OrderPayPackageController::class,'orderpaypackage_store']);
    Route::get('orderpaypackage_edit/{id}',[App\Http\Controllers\OrderPayPackageController::class,'orderpaypackage_edit']);
    Route::post('orderpaypackage_update/{id}',[App\Http\Controllers\OrderPayPackageController::class,'orderpaypackage_update']);
    Route::post('orderpaypackage_open_close',[App\Http\Controllers\OrderPayPackageController::class,'orderpaypackage_open_close']);
    //orderpaypackage

  Route::get('/logout',[App\Http\Controllers\AdminUserBackendController::class,'logout'])->name('logout');
    Route::get('/register',[App\Http\Controllers\AdminUserBackendController::class,'register'])->name('register');
    Route::get('/verify',[App\Http\Controllers\AdminUserBackendController::class,'verify'])->name('verify');

  });


