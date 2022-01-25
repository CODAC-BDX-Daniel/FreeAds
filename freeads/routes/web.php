<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MyAdsController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

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

// Show ads related to a specific user
Route::get('/my_ads/{userId}', [MyAdsController::class, 'index'])->name('my_ads')->middleware(['auth']);

Route::get('/ad_details/{id}', [AdController::class, 'show'])->name('ad_details/{id}');

Route::get('/home', [AdController::class, 'index'])->name('home');

Route::get('/ad_create', function () {
    return view('ad_create');
})->name('ad_create')->middleware(['auth']);

require __DIR__ . '/auth.php';

Route::resource('/', AdController::class);

Route::delete('/delete_ad/{ad_id}', [AdController::class, 'destroy'])->name('delete_ad/{ad_id}');

Route::get('/edit_ad/{ad_id}', [MyAdsController::class, 'show'])->name('edit_ad')->middleware(['auth']);

Route::post('/update_ad/{ad_id}', [MyAdsController::class, 'update'])->name('update_ad')->middleware(['auth']);


//Show ads specific to a category
Route::get('/category_ads/{categoryName}', [AdController::class, 'showOneCategoryAds'])->name('category_ads');

//FILTERS
//Filter ads displayed in one specific category
Route::any('/ads_filtered/{categoryName}',[AdController::class,'showOneCategoryAds'])->name('ads_filtered');


//ADMIN PAGE
Route::get('/adminPage', function () {
    return view('adminPage');
})->name('adminPage')->middleware(['admin']);

    //Ads management by AdminUser
Route::get('/ads_admin', [AdController::class, 'showAdsToAdmin']
)->name('ads_admin')->middleware(['admin']);

        //Destroy an ad by admin
Route::delete('/admin_delete_ad/{ad_id}', [AdController::class, 'destroy'])->name('admin_delete_ad')->middleware(['admin']);

    //Users management by AdminUser
        //Display users on the view users_admin
Route::get('/users_admin', [UserController::class, 'index'])->name('users_admin')->middleware(['admin']);
        //Show inside a form data about user to edit
Route::get('/display_user_edit_admin/{user_id}', [UserController::class, 'show'])->name('display_user_edit_admin')->middleware(['admin']);
        //Manage edit user by admin (click on edit button)
Route::post('/update_user_by_admin/{user_id}', [UserController::class, 'update'])->name('update_user_by_admin')->middleware(['admin']);
        //Delete an user by an admin
Route::delete('/admin_delete_user/{user_id}', [UserController::class, 'destroy'])->name('admin_delete_user')->middleware(['admin']);



