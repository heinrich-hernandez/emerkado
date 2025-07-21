<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AuthAdminController, ProfileController as AdminProfileController, UserController as AdminUserController, CoopController, MerchantController, BuyerController};
use App\Http\Controllers\Coop\{AuthCoopController, ProfileCoopController as CoopProfileController};
use App\Http\Controllers\Merchant\ProfileController as MerchantProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\AuthenticateSysUsers;
use Illuminate\Support\Facades\Auth; // Import Auth facade


Route::get('/user-login', [LoginController::class, 'getLogin'])->name('getLogin')->middleware('guest');
Route::post('/user-login', [LoginController::class, 'postLogin'])->name('postLogin')->middleware('guest');
Route::post('/user-logout', [LoginController::class, 'Logout'])->name('Logout');




// Admin routes
Route::middleware(['auth:admin', AuthenticateSysUsers::class])->group(function () {
    Route::get('/admin/dashboard', [AdminProfileController::class, 'dashboard'])->name('admin-dashboard');

    Route::get('/', function () {
        return redirect()->route('admin-dashboard');
    });

    Route::get('/admin', function () {
        return redirect()->route('admin-dashboard');
    });

    // Coop routes
    Route::get('/admin/coop', [AdminUserController::class, 'coop'])->name('pages.coop');
    // Create  
    Route::get('/admin/coop/create_coop', [AdminUserController::class, 'create_coop'])->name('pages.create_coop');
    Route::post('/admin/coop', [CoopController::class, 'add_coop'])->name('create.coop');
    // Delete
    Route::delete('/admin/coop/delete_coop/{id}', [AdminUserController::class, 'delete_coop']);
    // Approve
    Route::get('/admin/coop/approve_coop', [AdminUserController::class, 'approve_coop']);
    // Review Coop
    Route::get('/admin/coop/review_coop/id={id}', [AdminUserController::class, 'review_coop'])->name('pages.review_coop');
    Route::post('/admin/coop/review_coop/id={id}', [AdminUserController::class, 'approved_review_coop'])->name('approved.review_coop');


    // Merchant routes
    Route::get('/admin/merchant', [AdminUserController::class, 'merchant'])->name('pages.merchant');
    // Create
    Route::get('/admin/merchant/create_merchant', [AdminUserController::class, 'create_merchant'])->name('pages.create_merchant');
    Route::post('/admin/merchant', [MerchantController::class, 'add_merchant'])->name('create.merchant');
    // Delete
    Route::delete('/admin/merchant/delete_merchant/{id}', [AdminUserController::class, 'delete_merchant']);
    //Review merchant -- removed since it is no longer needed
    //Route::get('/admin/merchant/review_merchant/id={id}', [AdminUserController::class, 'review_merchant'])->name('pages.review_merchant');
    Route::get('/admin/merchant/approve_merchant', [AdminUserController::class, 'approve_merchant']);
    

    // Buyer routes
    Route::get('/admin/buyer', [AdminUserController::class, 'buyer'])->name('pages.buyer');
    // Create  
    Route::get('/admin/buyer/create_buyer', [AdminUserController::class, 'create_buyer'])->name('pages.create_buyer');
    Route::post('/admin/buyer', [BuyerController::class, 'add_buyer'])->name('create.buyer');
    // Delete
    Route::delete('/admin/buyer/delete_buyer/{id}', [AdminUserController::class, 'delete_buyer']);
    // Approve
    Route::get('/admin/buyer/approve_buyer', [AdminUserController::class, 'approve_buyer']);
    // Review Buyer
    Route::get('/admin/buyer/review_buyer/id={id}', [AdminUserController::class, 'review_buyer'])->name('pages.review_buyer');
    Route::post('/admin/buyer/review_buyer/id={id}', [AdminUserController::class, 'approved_review_buyer'])->name('approved.review_buyer');
});

// Coop routes
Route::middleware(['auth:coop', AuthenticateSysUsers::class])->group(function () {
    Route::get('/coop/dashboard', [CoopProfileController::class, 'dashboard'])->name('coop-dashboard');
});

// Merchant routes
Route::middleware(['auth:merchant', AuthenticateSysUsers::class])->group(function () {
    Route::get('/merchant/dashboard', [MerchantProfileController::class, 'dashboard'])->name('merchant-dashboard');
});


Route::get('/', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin-dashboard');
    } //elseif (Auth::guard('Coop')->check()) {
    //     return redirect()->route('coop-dashboard');
    // } elseif (Auth::guard('Buyer')->check()) {
    //     return redirect()->route('buyer-dashboard');
    // } elseif (Auth::guard('Merchant')->check()) {
    // return redirect()->route('merchant-dashboard');
    // }
    return redirect()->route('getLogin');
});