<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\ajaxController;
use App\Http\Controllers\User\UserController;
use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Symfony\Component\HttpKernel\DataCollector\AjaxDataCollector;

Route::middleware('admin_auth')->group(function () {
    // login,register page

    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});


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
            Route::post('passwordChange', [AdminController::class, 'passwordChange'])->name('adminAccount#passwordChange');

            // adminaccountinfo
            Route::get('detail', [AdminController::class, 'detail'])->name('adminAccount#detail');
            Route::get('edit', [AdminController::class, 'edit'])->name('adminAccount#edit');
            Route::post('update/{id}', [AdminController::class, 'update'])->name('adminAccount#update');

            // adminList 
            Route::get('list', [AdminController::class, 'list'])->name('adminAccount#list');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('adminAccount#delete');
            Route::get('changerole/{id}', [AdminController::class, 'changeRole'])->name('adminAccount#changeRole');
            Route::post('changerole/{id}', [AdminController::class, 'change'])->name('adminAccount#change');
        });

        // Product Route
        Route::group(['prefix' => 'product'], function () {
            // products
            Route::get('list', [ProductController::class, 'createPage'])->name('product#createPage');
            Route::get('createPage', [ProductController::class, 'createProduct'])->name('prodcut#createProduct');
            Route::post('create', [ProductController::class, 'create'])->name('product#create');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
            Route::get('detail/{id}', [ProductController::class, 'detail'])->name('product#detail');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product#edit');
            Route::post('update', [ProductController::class, 'update'])->name('product#update');
        });
    });

    //user page
    Route::group(['prefix' => 'User', 'middleware' => 'user_auth'], function () {

        Route::get('/userhome', [UserController::class, 'homePage'])->name('user#home');
        Route::get('filder/{id}', [UserController::class, 'filter'])->name('user#filter');

      

        // pizza detail
        Route::prefix('pizza')->group(function () {
            Route::get('detail/{id}', [UserController::class, 'pizzaDetail'])->name('user#pizzaDetail');
        });

        // cart
        Route::prefix('cart')->group(function () {
            Route::get('pizzaCart', [UserController::class, 'pizzaCart'])->name('cart#pizzaCart');
        });


        //  user change password
        Route::prefix('password')->group(function () {
            Route::get('changepage', [UserController::class, 'changePage'])->name('user#changePage');
            Route::post('change', [UserController::class, 'change'])->name('user#change');
        });

        //  user account update
        Route::prefix('account')->group(function () {
            Route::get('change', [UserController::class, 'accountChangePage'])->name('user#accountChangePage');
            Route::get('detail', [UserController::class, "detail"])->name('user#accountDetail');
            Route::post('changeAccount/{id}', [UserController::class, 'changeAccount'])->name('user#changeAccount');
        });
          // ajax pizza list
          Route::prefix('ajax')->group(function () {
            Route::get('pizza', [ajaxController::class, 'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart', [ajaxController::class, 'addToCart'])->name('ajax#addToCart');
            Route::get('order',[ajaxController::class,'order'])->name('ajax#order');
        });
    });
});
