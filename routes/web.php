<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('home');

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {return view('auth.login');})->name('login');
    Route::get('/register', function () {return view('auth.register');})->name('register');
});

Route::middleware(['auth'])->group(function () {

    // Admin Only Routes
    Route::middleware(['role:admin'])->group(function () {
        // Route::get('/admin/dashboard', [AdminController::class, 'index']);
    });

    // Supplier Only Routes
    Route::middleware(['role:supplier'])->group(function () {
        // Route::get('/supplier/inventory', [ProductController::class, 'manage']);
        // Route::post('/supplier/products', [ProductController::class, 'store']);
    });

    // Shared Routes (Admin OR Supplier can access)
    Route::middleware(['role:admin,supplier'])->group(function () {
        // Route::get('/reports', [ReportController::class, 'show']);
    });

});
