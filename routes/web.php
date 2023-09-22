<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomestayController;

use App\Http\Controllers\ViewController;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

// ' Pages '
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');

Route::get('/profile', [ProfileController::class, 'profilePage'])->name('profile');

Route::get('/homestay', [HomestayController::class, 'homestayPage'])->name('homestay');
Route::get('/culinary', [CulinaryController::class, 'culinaryPage'])->name('culinary');

Route::get('/souvenir', [ViewController::class, 'indexSouvenir'])->name('souvenir');
Route::get('/promo', [ViewController::class, 'indexPromo'])->name('promo');

Route::get('/destination', [ViewController::class, 'indexDestination'])->name('destination');
Route::get('/destinationDetail/{id}', [ViewController::class, 'indexDestinationDetail'])->name('destinationDetail');

// Route::get('/promo', function(){
//     return view('promo');
// })->name('promo');

Route::get('/contactUs', [ContactUsController::class, 'index']
)->name('contactUs');

// ' API '
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::post('/editProfile', [ProfileController::class, 'editProfile']);

// ' Admin '
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin', function () {
        return view('admin.home');
    });
});

// Homestay
Route::get('/tableHomestay', [ViewController::class, 'indexAdminHomestay'])->name('tableHomestay');

Route::get('/createHomestay', function(){
    return view('admin.createHomestay');
});
Route::post('/storeHomestay', [RegisterController::class, 'addHomestay'])->name('storehs');

Route::get('/editTableHomestay/{id}', [ViewController::class, 'indexAdminEditHomestay']);
Route::post('/editTableHomestay/{id}/edit', [RegisterController::class, 'editHomestay'])->name('ediths');

Route::delete('/deleteTableHomestay/{id}', [RegisterController::class, 'deleteHomestay'])->name('deletehs');
// ----------------------------------

// Culinary
Route::get('/tableCulinary', [ViewController::class, 'indexAdminCulinary'])->name('tableCulinary');

Route::get('/createCulinary', function(){
    return view('admin.createCulinary');
});
Route::post('/createCulinary/add', [RegisterController::class, 'addCulinary'])->name('storec');

Route::get('/editCulinary/{id}', [ViewController::class, 'indexAdminEditCulinary']);
Route::post('editCulinary/{id}/edit', [RegisterController::class, 'editCulinary'])->name('editc');

Route::delete('/deleteTableCulinary/{id}', [RegisterController::class, 'deleteCulinary'])->name('deletec');
// -----------------------------------

// Destination
Route::get('/tableDestination', [ViewController::class, 'indexAdminDestination'])->name('tableDestination');

Route::get('/createDestination', function(){
    return view('admin.createDestination');
});
Route::post('/createDestination/add', [RegisterController::class, 'addDestination'])->name('stored');

Route::get('/editDestination/{id}', [ViewController::class, 'indexAdminEditDestination']);
Route::post('editDestination/{id}/edit', [RegisterController::class, 'editDestination'])->name('editd');

Route::delete('/deleteTableDestination/{id}', [RegisterController::class, 'deleteDestination'])->name('deleted');
// -----------------------------------


// Souvenir
Route::get('/tableSouvenir', [ViewController::class, 'indexAdminSouvenir'])->name('tableSouvenir');

Route::get('/createSouvenir', function(){
    return view('admin.createSouvenir');
});
Route::post('/createSouvenir/add', [RegisterController::class, 'addSouvenir'])->name('stores');

Route::get('/editSouvenir/{id}', [ViewController::class, 'indexAdminEditSouvenir']);
Route::post('editSouvenir/{id}/edit', [RegisterController::class, 'editSouvenir'])->name('edits');

Route::delete('/deleteTableSouvenir/{id}', [RegisterController::class, 'deleteSouvenir'])->name('deletes');
// -----------------------------------

// Promo
Route::get('/tablePromo', [ViewController::class, 'indexAdminPromo'])->name('tablePromo');

Route::get('/createPromo', function(){
    return view('admin.createPromo');
});
Route::post('/createPromo/add', [RegisterController::class, 'addPromo'])->name('storep');

Route::get('/editPromo/{id}', [ViewController::class, 'indexAdminEditPromo']);
Route::post('editPromo/{id}/edit', [RegisterController::class, 'editPromo'])->name('editp');

Route::delete('/deleteTablePromo/{id}', [RegisterController::class, 'deletePromo'])->name('deletep');

// -----------------------------------


// Route::get('/clear', function() {
//     Artisan::call('cache:clear');
//     Artisan::call('config:cache');
//     Artisan::call('view:clear');
//     return "Cleared!";
// });
