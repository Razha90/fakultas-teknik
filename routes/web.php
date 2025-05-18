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
use Livewire\Volt\Volt;

// Ganti bahasa
Route::get('lang', [LanguageController::class, 'change'])->name('change.lang');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Volt::route('example', 'admin/example-bootstrap')->name('example');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
