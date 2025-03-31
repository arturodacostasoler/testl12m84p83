<?php

use App\Models\Level;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::redirect('settings', 'settings/profile');

//     Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
//     Volt::route('settings/password', 'settings.password')->name('settings.password');
//     Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
// });

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {

        Route::get('/', function () {

            $users = User::get();

            return view('welcome', ['users' => $users]);
        })->name('home');

        Route::view('dashboard', 'dashboard')
            ->middleware(['auth', 'verified'])
            ->name('dashboard');

        Route::middleware(['auth'])->group(function () {
            Route::redirect('settings', 'settings/profile');

            Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
            Volt::route('settings/password', 'settings.password')->name('settings.password');
            Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
        });

        Route::get('/profile/{id}', function ($id) {
            $user = User::find($id);
            // dd($user->name);

            $posts = $user->posts()
                ->with('category', 'image', 'tags')
                ->withCount('comments')->get();

            $videos = $user->videos()
                ->with('category', 'image', 'tags')
                ->withCount('comments')->get();

            return view('profile', [
                "user" => $user,
                "posts" => $posts,
                "videos" => $videos,
            ]);
        })->name('profile');

        Route::get('/level/{id}', function ($id) {
            $level = Level::find($id);
            // dd($user->name);

            $posts = $level->posts()
                ->with('category', 'image', 'tags')
                ->withCount('comments')->get();

            $videos = $level->videos()
                ->with('category', 'image', 'tags')
                ->withCount('comments')->get();

            return view('level', [
                "level" => $level,
                "posts" => $posts,
                "videos" => $videos,
            ]);
        })->name('level');
    });
}

require __DIR__ . '/auth.php';
