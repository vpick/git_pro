<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ResetPasswordController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\SubCategoryController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\AjaxController;

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



Route::get('/', [LoginController::class,'index'])->name('login');
Route::post('login', [LoginController::class,'store'])->name('login.store');
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('/logout', function () {
        Auth::logout();
        return Redirect('/');
    });
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('reset-password', ResetPasswordController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubCategoryController::class);
    Route::resource('product', ProductController::class);
    // // ajax call load subcategory
    Route::get('load/subcategory/{id}', [AjaxController::class, 'getsubcat']);
   
});
