<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AuthController, ProfileController as AdminProfileController, UserController as AdminUserController, CoopController, MerchantController};
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
    // // Review merchant -- removed since it is no longer needed
    // Route::get('/admin/merchant/review_merchant/id={id}', [AdminUserController::class, 'review_merchant'])->name('pages.review_merchant');
    // Route::post('/admin/merchant/review_merchant/id={id}', [AdminUserController::class, 'approved_review_merchant'])->name('approved.review_merchant');
    

    // Buyer routes
    Route::get('/admin/buyer', [AdminUserController::class, 'buyer'])->name('pages.buyer');


});


