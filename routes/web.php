<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category;
use App\Http\Controllers\AddMovie;
use App\Http\Controllers\AdminSignin;
use App\Http\Controllers\SubscriptionType;
use App\Http\Controllers\UserDashbord;
use App\Http\Controllers\UserRegister;
use App\Http\Controllers\UserLogin;
use App\Http\Controllers\Usersubscription;
use App\Http\Controllers\UserCategory;
use App\Http\Controllers\Payment;

Route::get('/', [AdminSignin::class, 'index'])->name('login');

Route::post('/admin_login', [AdminSignin::class, 'login'])
    ->name('admin_login');

Route::get('/logout', [AdminSignin::class, 'logout'])
    ->name('logout');



Route::middleware('adminauth')->group(function () {

    Route::get('addcategory', [Category::class, 'index'])
        ->name('addcategory');

    Route::post('category_store', [Category::class, 'store'])
        ->name('category_store');

    Route::get('category_fetch', [Category::class, 'fetch'])
        ->name('category_fetch');

    Route::post('/category/update/{id}', [Category::class, 'update']);

    Route::post('/category/delete/{id}', [Category::class, 'delete']);

    Route::get('add_video', [AddMovie::class, 'index'])
        ->name('add_video');

    Route::post('store_video', [AddMovie::class, 'store'])
        ->name('store_video');

    Route::get('/video_fetch', [AddMovie::class, 'fetchVideo'])
    ->name('video_fetch');

    Route::post('/update_video/{id}', [AddMovie::class, 'update'])
    ->name('update_video');
    Route::post('/delete_video/{id}', [AddMovie::class, 'delete'])
    ->name('delete_video');



    Route::get('add_subcription', [SubscriptionType::class, 'index'])
        ->name('add_subcription');
    Route::post('/store_subscription', [SubscriptionType::class, 'store'])
    ->name('store_subscription');
    Route::get('/subscription_fetch', [SubscriptionType::class, 'fetchSubscription'])
    ->name('subscription_fetch');
  Route::post('/update_subscription/{id}', [SubscriptionType::class, 'update'])
    ->name('update_subscription');
    Route::post('/delete_subscription/{id}', [SubscriptionType::class, 'delete'])
    ->name('delete_subscription');

});

    Route::get('dashboard', [UserDashbord::class, 'index'])
            ->name('dashboard');
    Route::get('register', [UserRegister::class, 'index'])
        ->name('register');
    Route::post('store_user', [UserRegister::class, 'store']) ->name('store_user');
    Route::get('user_login',[UserLogin::class,'index'])->name('user_login');
    Route::post('login-check', [UserLogin::class,'loginCheck'])->name('login.check');
  Route::get('userlogout', [UserLogin::class,'logout'])->name('userlogout');
    Route::get('subscription', [Usersubscription::class, 'index']) ->name('subscription');
     Route::get('categories',[UserCategory::class,'index'])->name('categories');
    Route::get('category-videos/{id}',[UserCategory::class, 'categoryVideos']) ->name('category.videos');
    // Route::get('payment_page',[Payment::class, 'index']) ->name('payment_page');
    Route::get( 'payment_page/{id}', [Payment::class, 'index'])->name('payment_page');
    Route::get('payment-success/{id}',[Payment::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/watch-video/{id}', [UserDashbord::class, 'watchVideo']);
