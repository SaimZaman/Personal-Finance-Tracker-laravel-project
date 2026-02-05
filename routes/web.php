<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return redirect('/login');
});

// Debug route (remove in production)
Route::get('/debug-session', function () {
    return [
        'session_id' => session()->getId(),
        'csrf_token' => csrf_token(),
        'user' => Auth::user(),
        'session_data' => session()->all(),
    ];
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Register
|--------------------------------------------------------------------------
*/

Route::get('/register', function () {
    return view('registration');
})->name('register');

Route::post('/register', [RegisterController::class, 'store']);

/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboards
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'check.user.status'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Admin User Management Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', App\Http\Controllers\AdminUserController::class);
        Route::patch('users/{user}/toggle-status', [App\Http\Controllers\AdminUserController::class, 'toggleStatus'])
            ->name('users.toggle-status');
    });

    Route::get('/user/dashboard', [TransactionController::class, 'index'])->name('user.dashboard');
    
    // Transaction routes
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

    // Add a general dashboard route that redirects based on user type
    Route::get('/dashboard', function () {
        if (Auth::user()->usertype === 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/user/dashboard');
    })->name('dashboard');

});
