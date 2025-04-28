<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('lang', [LanguageController::class, 'change'])->name('change.lang');

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');
Volt::route('/', 'home')->name('home');
Volt::route('/news/{id}', 'news-page')->name('news-page');
Volt::route('/search', 'news-search')->name('news-search');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Volt::route('example', 'admin/example-bootstrap')->name('example');
Volt::route('profile', 'profile')->name('profile');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
