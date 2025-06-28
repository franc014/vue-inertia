<?php

use App\Models\Product;
use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/food', function () {
    return Inertia::render('Food');
})->name('food');

Route::get('/teams', function () {
    return Inertia::render('Teams', [
        'team' => Team::with('teamMembers')->find(1),
    ]);
})->name('teams');

Route::get('/products', function () {
    return Inertia::render('Products', [
        'products' => Product::all(),
    ]);
});



Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
