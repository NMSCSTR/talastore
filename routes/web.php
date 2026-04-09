<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController; // New Controller
use App\Http\Controllers\CheckoutController; // New Controller
use Illuminate\Support\Facades\Route;

// Public Routes (Accessible by everyone)
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Public Checkout Routes (The "Fork in the Road")
// We keep these outside of 'guest' or 'auth' so everyone can see the cart/guest forms
Route::get('/checkout/guest', [CheckoutController::class, 'guestIndex'])->name('checkout.guest');
Route::post('/checkout/guest', [CheckoutController::class, 'processGuestCheckout'])->name('checkout.guest.post');

// Guest-Only Routes (Redirects to dashboard if already logged in)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () { return view('auth.login'); })->name('login');
    Route::get('/register', function () { return view('auth.register'); })->name('register');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    // Auth-Only Checkout (For logged-in users)
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

    // Admin Only Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // User Management
        Route::prefix('admin/users')->name('admin.users.')->group(function() {
            Route::get('/', [AdminController::class, 'users'])->name('index');
            Route::post('/', [AdminController::class, 'storeUser'])->name('store');
            Route::delete('/{user}', [AdminController::class, 'destroyUser'])->name('destroy');
            Route::put('/{user}', [AdminController::class, 'updateUser'])->name('update');
        });

        // Product Management
        Route::prefix('admin/products')->name('admin.products.')->group(function() {
            Route::get('/', [AdminController::class, 'products'])->name('index');
            Route::post('/', [AdminController::class, 'storeProduct'])->name('store');
            Route::put('/{product}', [AdminController::class, 'updateProduct'])->name('update');
            Route::delete('/{product}', [AdminController::class, 'destroyProduct'])->name('destroy');
        });
    });

    // Supplier Only Routes
    Route::middleware(['role:supplier'])->group(function () {
        // Route::get('/supplier/inventory', [ProductController::class, 'manage']);
    });

    // Shared Admin/Supplier
    Route::middleware(['role:admin,supplier'])->group(function () {
        // Route::get('/reports', [ReportController::class, 'show']);
    });
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
