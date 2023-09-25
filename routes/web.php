<?php

use App\Http\Controllers\HomeController;

use App\Http\Controllers\HomestayController;
use App\Http\Controllers\CulinaryController;
use App\Http\Controllers\SouvenirController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\DestinationController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Route;

// ' Homepage '
Route::get('/', [HomeController::class, 'homePage'])->name('homePage');

// ' Browse '
Route::get('/homestay', [HomestayController::class, 'homestayPage'])->name('homestayPage');
Route::get('/culinary', [CulinaryController::class, 'culinaryPage'])->name('culinaryPage');
Route::get('/souvenir', [SouvenirController::class, 'souvenirPage'])->name('souvenirPage');
Route::get('/promo', [PromoController::class, 'promoPage'])->name('promoPage');

Route::get('/destination', [DestinationController::class, 'destinationPage'])->name('destinationPage');
Route::get('/destination/{id}', [DestinationController::class, 'destinationDetailPage'])->name('destinationDetailPage');

// ' Contact us '
Route::get('/contact-us', [ContactUsController::class, 'contactPage'])->name('contactUsPage');

// ' Auth '
Route::get('/register', [AuthController::class, 'registerPage'])->name('registerPage');
Route::get('/login', [AuthController::class, 'loginPage'])->name('loginPage');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ' Authenticated '
Route::middleware('auth')->group(function() {
    // ' User '
    Route::get('/profile', [UserController::class, 'profilePage'])->name('profilePage');
    Route::post('/editProfile', [UserController::class, 'editProfile'])->name('editProfilePage');

    // ' Admin '
    Route::middleware('admin')->group(function() {
        Route::get('/admin', [AdminController::class, 'adminHomePage']);

        Route::get('/admin/{table}', [AdminController::class, 'tablePage']);
        Route::get('/admin/{table}/add', [AdminController::class, 'addTablePage']);
        Route::get('/admin/{table}/{id}', [AdminController::class, 'editTablePage']);

        Route::post('/admin/{table}/add', [AdminController::class, 'addTable']);
        Route::post('/admin/{table}/{id}/edit', [AdminController::class, 'editTable']);
        Route::delete('/admin/{table}/{id}/delete', [AdminController::class, 'deleteTable']);
    });
});
