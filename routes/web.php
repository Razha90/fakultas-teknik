<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LanguageController;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Test;
use App\Livewire\Admin\Users\UserProfile;

use App\Livewire\Admin\Departments\DepartmentList;
use App\Livewire\Admin\Category\CategoryList;
use App\Livewire\Admin\Contents\ContentCreate;
use App\Livewire\Admin\Contents\ContentEdit;
use App\Livewire\Admin\Contents\ContentList;
use App\Livewire\Admin\ContentType\ContentTypeList;
use App\Livewire\Admin\Users\UserCreate;
use App\Livewire\Admin\Users\UserIndex;

// Ganti bahasa
Route::get('lang', [LanguageController::class, 'change'])->name('change.lang');

// Public / welcome
Route::get('/', fn () => view('welcome'))->name('home');

// Login Page
Route::middleware('guest')->group(function () {
    Route::get('/login', LoginPage::class)->name('login');
});

// After login
Route::middleware(['auth', 'ensure.authenticated'])->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/dashboard/test', Test::class)->name('dashboard.test');
    Route::get('/users/profile', UserProfile::class)->name('users.profile');

    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');

    // ===== Route yang hanya bisa diakses oleh ADMIN =====
    Route::middleware('role:admin')->group(function () {
        Route::get('/users', UserIndex::class)->name('users.index');
        Route::get('/content', ContentList::class)->name('contents.index');
        Route::get('/content/create', ContentCreate::class)->name('content.create');
        Route::get('/content/{id}/edit', ContentEdit::class)->name('content.edit');
    });

    // ===== Route yang hanya bisa diakses oleh STAFF (akses penuh) =====
    Route::middleware('role:staff')->group(function () {
        // Semua yang bisa admin akses
        Route::get('/users', UserIndex::class)->name('users.index');
        Route::get('/content', ContentList::class)->name('contents.index');
        Route::get('/content/create', ContentCreate::class)->name('content.create');
        Route::get('/content/{id}/edit', ContentEdit::class)->name('content.edit');

        // Tambahan untuk staff
        Route::get('/categories', CategoryList::class)->name('categories.index');
        Route::get('/departments', DepartmentList::class)->name('departments.index');
        Route::get('/users/create', UserCreate::class)->name('users.create');
        Route::get('/contentType', ContentTypeList::class)->name('contentType.index');
    });
});
