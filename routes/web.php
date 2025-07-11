<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AuthController, ProfileController as AdminProfileController, UserController as AdminUserController, CoopController};
use App\Http\Controllers\Merchant\ProfileController as MerchantProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\AuthenticateSysUsers;

// Route::get('/', function () {
//     return view('auth.login');
// });

//ADMIN FUNCTIONS
// Route::get('/admin/login', [AuthController::class, 'getLogin'])->name('getLogin');
// Route::post('/admin/login', [AuthController::class, 'postLogin'])->name('postLogin');
// Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->name('adminLogout');



//Route::group(['middleware'=>['admin_auth']],function(){});

// Route::middleware([AdminAuth::class])->group(function () {
//     Route::get('/admin/dashboard', [AdminProfileController::class, 'dashboard'])->name('admin-dashboard');
//     Route::get('/admin/coop', [UserController::class, 'coop'])->name('pages.coop');
//     Route::get('/admin/merchant', [UserController::class, 'merchant'])->name('pages.merchant');
//     Route::get('/admin/coop/create_coop', [UserController::class, 'create_coop'])->name('pages.create_coop');
//     Route::post('/admin/merchant', [UserController::class, 'add_merchant'])->name('create.merchant');
//     Route::post('/admin/coop', [CoopController::class, 'add_coop'])->name('create.coop');
//     Route::get('/admin/merchant/create_merchant', [UserController::class, 'create_merchant'])->name('pages.create_merchant');
//     Route::get('/admin/buyer', [UserController::class, 'buyer'])->name('pages.buyer');
// });

// xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

// FOR TESTING ...

// Auth::routes();

Route::get('/user-login', [LoginController::class, 'getLogin'])->name('getLogin');
// Route::get('/login', [LoginController::class, 'getLogin'])->name('login');
Route::post('/user-login', [LoginController::class, 'postLogin'])->name('postLogin');
Route::post('/user-logout', [LoginController::class, 'Logout'])->name('Logout');

Route::middleware(['auth:merchant', AuthenticateSysUsers::class])->group(function () {
    Route::get('/merchant/dashboard', [MerchantProfileController::class, 'dashboard'])->name('merchant-dashboard');
});

Route::middleware(['auth:admin', AuthenticateSysUsers::class])->group(function () {
    Route::get('/admin/dashboard', [AdminProfileController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('/admin/coop', [AdminUserController::class, 'coop'])->name('pages.coop');
    Route::get('/admin/coop/review_coop/id={id}', [AdminUserController::class, 'review_coop'])->name('pages.review_coop');
    Route::post('/admin/coop/review_coop/id={id}', [AdminUserController::class, 'approved_review_coop'])->name('approved.review_coop');
    Route::get('/admin/merchant', [AdminUserController::class, 'merchant'])->name('pages.merchant');
    Route::get('/admin/coop/create_coop', [AdminUserController::class, 'create_coop'])->name('pages.create_coop');
    Route::post('/admin/merchant', [AdminUserController::class, 'add_merchant'])->name('create.merchant');
    Route::delete('/admin/coop/delete_coop/{id}', [AdminUserController::class, 'delete_coop']);
    Route::get('/admin/coop/approve_coop', [AdminUserController::class, 'approve_coop']);
    Route::post('/admin/coop', [CoopController::class, 'add_coop'])->name('create.coop');
    Route::get('/admin/merchant/create_merchant', [AdminUserController::class, 'create_merchant'])->name('pages.create_merchant');
    Route::get('/admin/buyer', [AdminUserController::class, 'buyer'])->name('pages.buyer');
});

// Route::middleware(['auth:coop', AuthenticateSysUsers::class])->group(function () {
//     Route::get('/coop/dashboard', [CoopProfileController::class, 'dashboard'])->name('coop-dashboard');
// });

// Route::middleware(['auth:buyer', AuthenticateSysUsers::class])->group(function () {
//     Route::get('/buyer/dashboard', [BuyerProfileController::class, 'dashboard'])->name('buyer-dashboard');
// });


// xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx



//TEMPLATE FUNCTIONS (from the original template. it might broke something if this code be remove.)


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::middleware('auth')->group(function () {
//     Route::view('about', 'about')->name('about');

//     Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

//     Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
//     Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
// });


