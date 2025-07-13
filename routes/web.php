<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AuthController, ProfileController as AdminProfileController, UserController as AdminUserController, CoopController};
use App\Http\Controllers\Merchant\ProfileController as MerchantProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\AuthenticateSysUsers;


Route::get('/user-login', [LoginController::class, 'getLogin'])->name('getLogin');
Route::post('/user-login', [LoginController::class, 'postLogin'])->name('postLogin');
Route::post('/user-logout', [LoginController::class, 'Logout'])->name('Logout');


// Redirect root URL to user login if not authenticated
Route::get('/', function () {
    return redirect()->route('getLogin');
})->middleware('guest'); // Only redirect if the user is a guest


// Admin routes
Route::middleware('auth:admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin-dashboard');
    });

    Route::get('/admin', function () {
        return redirect()->route('admin-dashboard');
    });
});

Route::middleware(['auth:admin', AuthenticateSysUsers::class])->group(function () {
    Route::get('/admin/dashboard', [AdminProfileController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('/admin/coop', [AdminUserController::class, 'coop'])->name('pages.coop');
    Route::get('/admin/coop/review_coop/id={id}', [AdminUserController::class, 'review_coop'])->name('pages.review_coop');
    Route::post('/admin/coop/review_coop/id={id}', [AdminUserController::class, 'approved_review_coop'])->name('approved.review_coop');
    Route::get('/admin/merchant', [AdminUserController::class, 'merchant'])->name('pages.merchant');
    Route::get('/admin/merchants/review_merchants/id={id}', [AdminUserController::class, 'review_merchants'])->name('pages.review_merchants');
    Route::post('/admin/merchants/review_merchants/id={id}', [AdminUserController::class, 'approved_review_merchants'])->name('approved.review_merchants');
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

// Route::middleware(['auth:merchant', AuthenticateSysUsers::class])->group(function () {
//     Route::get('/merchant/dashboard', [MerchantProfileController::class, 'dashboard'])->name('merchant-dashboard');
// });


// Route::middleware(['auth:buyer', AuthenticateSysUsers::class])->group(function () {
//     Route::get('/buyer/dashboard', [BuyerProfileController::class, 'dashboard'])->name('buyer-dashboard');
// });

