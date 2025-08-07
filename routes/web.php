<?php

use Illuminate\Support\Facades\{Route, Auth};
use App\Http\Controllers\Admin\{AuthAdminController, ProfileController as AdminProfileController, UserController as AdminUserController, CoopController, MerchantController, BuyerController};
use App\Http\Controllers\Coop\{AuthCoopController, ProfileCoopController as CoopProfileController};
use App\Http\Controllers\Merchant\{AuthMerchantController, ProfileMerchantController as MerchantProfileController, UserController as MerchantUserController};
use App\Http\Controllers\Buyer\{AuthBuyerController, ProfileBuyerController as BuyerProfileController};
use App\Http\Controllers\Auth\{LoginController, RegisterController};
use App\Http\Middleware\{AuthenticateSysUsers, AdminAuth, CoopAuth, BuyerAuth, MerchantAuth};
use App\Http\Livewire\Notification;

// Login routes
Route::get('/user-login', [LoginController::class, 'getLogin'])->name('getLogin')->middleware('guest');
Route::post('/user-login', [LoginController::class, 'postLogin'])->name('postLogin')->middleware('guest');
Route::post('/user-logout', [LoginController::class, 'Logout'])->name('Logout');

// Register routes
Route::get('/register', [RegisterController::class, 'showRoleSelectionForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->name('postRegister')->middleware('guest');

// Register Role Routes
Route::get('/coop/register', [AuthCoopController::class, 'getRegisterCoop'])->name('coop.auth.register')->middleware('guest');
Route::post('/coop/register', [AuthCoopController::class, 'postRegisterCoop'])->name('user.create.coop')->middleware('guest');
Route::get('/buyer/register', [AuthBuyerController::class, 'getRegisterBuyer'])->name('buyer.auth.register')->middleware('guest');
Route::post('/buyer/register', [AuthBuyerController::class, 'postRegisterBuyer'])->name('user.create.buyer')->middleware('guest');




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
    // Create Buyer
    Route::get('/admin/buyer/create_buyer', [AdminUserController::class, 'create_buyer'])->name('pages.create_buyer');
    Route::post('/admin/buyer', [BuyerController::class, 'add_buyer'])->name('create.buyer');
    // Delete Buyer
    Route::delete('/admin/buyer/delete_buyer/{id}', [AdminUserController::class, 'delete_buyer']);
    // Approve Buyer
    Route::get('/admin/buyer/approve_buyer', [AdminUserController::class, 'approve_buyer']);
    // Review Buyer
    Route::get('/admin/buyer/review_buyer/id={id}', [AdminUserController::class, 'review_buyer'])->name('pages.review_buyer');
    Route::post('/admin/buyer/review_buyer/id={id}', [AdminUserController::class, 'approved_review_buyer'])->name('approved.review_buyer');

    // Review Routes
    Route::get('/admin/review', [AdminUserController::class, 'review'])->name('pages.review');
    Route::get('/admin/review/id={id}', [AdminUserController::class, 'review_details'])->name('pages.review_details');
    Route::post('/admin/review/id={id}', [AdminUserController::class, 'approved_review'])->name('approved.review');
});

// Coop routes
Route::middleware(['auth:coop', AuthenticateSysUsers::class])->group(function () {
    Route::get('/coop/dashboard', [CoopProfileController::class, 'dashboard'])->name('coop-dashboard');
    Route::get('/coop/profile/', [CoopProfileController::class, 'profile'])->name('coop-profile');
});

// Buyer routes
Route::middleware(['auth:buyer', AuthenticateSysUsers::class])->group(function () {
    Route::get('/buyer/dashboard', [BuyerProfileController::class, 'dashboard'])->name('buyer-dashboard');
    Route::get('/buyer/profile/', [BuyerProfileController::class, 'profile'])->name('buyer-profile');
});


// Merchant routes
Route::middleware(['auth:merchant', AuthenticateSysUsers::class])->group(function () {
    Route::get('/merchant/profile/', [MerchantProfileController::class, 'profile'])->name('merchant-profile');

    Route::get('/merchant/dashboard', [MerchantProfileController::class, 'dashboard'])->name('merchant-dashboard');

    // Coop routes
    Route::get('/merchant/coop', [MerchantUserController::class, 'merchant_coop'])->name('merchant.pages.coop');
    // Buyer routes
    Route::get('/merchant/buyer', [MerchantUserController::class, 'merchant_buyer'])->name('merchant.pages.buyer');

    // Review Routes

    // Approve Coop
    Route::get('/merchant/coop/merchant_approve_coop', [MerchantUserController::class, 'merchant_approve_coop']);
    // Review Coop
    Route::get('/merchant/coop/review_coop/id={id}', [MerchantUserController::class, 'merchant_review_coop'])->name('pages.review_coop');
    Route::post('/merchant/coop/review_coop/id={id}', [MerchantUserController::class, 'merchant_approved_review_coop'])->name('approved.review_coop');
    


    // Approve Buyer
    Route::get('/merchant/buyer/merchant_approve_buyer', [MerchantUserController::class, 'merchant_approve_buyer']);
    // Review Buyer
    Route::get('/merchant/buyer/review_buyer/id={id}', [MerchantUserController::class, 'merchant_review_buyer'])->name('pages.review_buyer');
    Route::post('/merchant/buyer/review_buyer/id={id}', [MerchantUserController::class, 'merchant_approved_review_buyer'])->name('approved.review_buyer');
    
});


Route::get('/', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin-dashboard');
    } elseif (Auth::guard('coop')->check()) {
        return redirect()->route('coop-dashboard');
    } elseif (Auth::guard('buyer')->check()) {
        return redirect()->route('buyer-dashboard');
    } elseif (Auth::guard('merchant')->check()) {
    return redirect()->route('merchant-dashboard');
    }
    return redirect()->route('getLogin');
});