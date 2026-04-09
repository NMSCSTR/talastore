<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [ProductController::class, 'index'])->name('home');

// Shopping Cart Actions
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Public Checkout (The "Fork")
Route::get('/checkout/guest', [CheckoutController::class, 'guestIndex'])->name('checkout.guest');
Route::post('/checkout/guest', [CheckoutController::class, 'processGuestCheckout'])->name('checkout.guest.post');

/*
|--------------------------------------------------------------------------
| Guest Only (Redirects if Logged In)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', function () { return view('auth.login'); })->name('login');
    Route::get('/register', function () { return view('auth.register'); })->name('register');
    Route::post('/login', [AuthController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Member Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /* --- Admin Only --- */
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

    /* --- Supplier Only --- */
    Route::middleware(['role:supplier'])->group(function () {
        // Route::get('/supplier/inventory', [ProductController::class, 'manage']);
    });

    /* --- Shared Roles --- */
    Route::middleware(['role:admin,supplier'])->group(function () {
        // Route::get('/reports', [ReportController::class, 'show']);
    });
});
