<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\AdminLoginController;

Route::get('/', function () {
    return view('welcome');
});

// Handles login,logout, registration, email verification,Forgot password reset link
Auth::routes(['verify' => true]); 

// Social Login Routes
Route::get('login/{provider}', [SocialLoginController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback']);

// Home route (requires email verification)
Route::get('/home', [HomeController::class, 'index'])->middleware('verified')->name('home');

Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login']);
Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();

    // Redirect based on user role
    if ($user->hasRole('Super Admin')) {
        return redirect()->route('superadmin.dashboard');
    } elseif ($user->hasRole('Admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('Agent') || $user->hasRole('User')) {
        return redirect()->route('user.dashboard');
    }

    return abort(403, 'Unauthorized Access');
})->middleware('auth')->name('dashboard');

// User & Agent Dashboard
Route::middleware(['auth', 'role:User,Agent'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
});

// Admin Dashboard
Route::middleware(['auth', 'adminRole:Admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
});

// Super Admin Dashboard
Route::middleware(['auth', 'adminRole:Super Admin'])->group(function () {
    Route::get('/superadmin/dashboard', [DashboardController::class, 'superAdminDashboard'])->name('superadmin.dashboard');
});
