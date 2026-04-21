<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeamMemberController;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ==================== NAMED LOGIN ROUTE ====================
Route::get('/login', function () {
    return redirect('/login-page');
})->name('login');

// ==================== LANDING PAGE ====================
Route::get('/', function () {
    $posts = \App\Models\Post::with('user')->latest()->take(6)->get();
    return view('welcome', ['posts' => $posts]);
});

// ==================== ABOUT PAGE ====================
Route::get('/about', function () {
    return view('about');
})->name('about');

// ==================== LOGIN & REGISTER PAGES ====================
Route::get('/login-page', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return view('login');
})->name('login.page');

Route::get('/register-page', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return view('register');
})->name('register.page');

// ==================== AUTHENTICATION ROUTES ====================
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);

// ==================== PASSWORD RESET ROUTES ====================
Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');

// ==================== CONTACT ROUTE ====================
Route::post('/contact', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'message' => 'required|string',
    ]);

    Contact::create([
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->message,
        'is_read' => false,
    ]);

    return redirect('/#contact')->with('success', 'Message sent successfully! We will get back to you soon.');
})->name('contact');

// ==================== DASHBOARD & PROTECTED ROUTES ====================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $posts = auth()->user()->userCoolPosts()->latest()->get();
        return view('home', ['posts' => $posts]);
    })->name('dashboard');

    Route::post('/change-password', [UserController::class, 'changePassword']);
    Route::post('/update-profile-picture', [UserController::class, 'updateProfilePicture']);
    Route::delete('/remove-profile-picture', [UserController::class, 'removeProfilePicture']);
    Route::post('/create-post', [PostController::class, 'createPost']);
    Route::get('/edit-post/{id}', [PostController::class, 'showEditForm']);
    Route::put('/edit-post/{id}', [PostController::class, 'updatePost']);
    Route::delete('/delete-post/{id}', [PostController::class, 'deletePost']);
});

// ==================== ADMIN ROUTES ====================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
    Route::post('/contacts/{id}/read', [AdminController::class, 'markAsRead'])->name('contacts.read');
    Route::delete('/contacts/{id}', [AdminController::class, 'deleteContact'])->name('contacts.delete');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Team Member Routes
    Route::get('/team', [TeamMemberController::class, 'index']);
    Route::get('/team/create', [TeamMemberController::class, 'create']);
    Route::post('/team', [TeamMemberController::class, 'store']);
    Route::get('/team/{id}/edit', [TeamMemberController::class, 'edit']);
    Route::put('/team/{id}', [TeamMemberController::class, 'update']);
    Route::delete('/team/{id}', [TeamMemberController::class, 'destroy']);
    Route::get('/team/{id}/toggle', [TeamMemberController::class, 'toggleStatus']);
});

// ==================== EMAIL VERIFICATION ROUTE ====================
Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();

    if (auth()->user()->email === 'admin@blogplatform.com') {
        return redirect('/admin/dashboard')->with('success', 'Email verified! Welcome Admin!');
    }

    return redirect('/dashboard')->with('success', 'Email verified! You can now login.');
})->middleware(['auth', 'signed'])->name('verification.verify');