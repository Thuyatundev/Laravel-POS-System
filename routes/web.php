<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use PHPUnit\TextUI\XmlConfiguration\Group;

// login,register page

Route::redirect('/', 'loginPage');
Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');

Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::middleware(['admin_auth'])->group(function () {

        // category route
        Route::group(['prefix' => 'Category'], function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('createPage', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

         // admin account
         Route::group(['prefix' => 'adminAccount'], function () {
            // adminpassword change
            Route::get('changePassword', [AdminController::class, 'changepassword'])->name('adminAccount#changePassword');
            Route::post('passwordChange',[AdminController::class, 'passwordChange'])->name('adminAccount#passwordChange');

            // adminaccountinfo
            Route::get('detail',[AdminController::class,'detail'])->name('adminAccount#detail');
            
         });
    });

    //user page
    Route::group(['prefix' => 'User', 'middleware' => 'user_auth'], function () {
        Route::get('home', function () {
            return  view('user.home');
        })->name('user#home');
    });
});
