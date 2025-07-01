<?php

use App\Models\Cart;
use App\Models\Product;
use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

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

Route::post('/cart/create', function () {

    $UICartId = request('id');

    Log::info('UICartId', [$UICartId]);

    return Cart::create([
        'ui_cart_id' => $UICartId
    ]);

})->name('cart.create');

Route::post('/cart/show', function () {

    $cart = Cart::byUICartId(request('id'))->first();

    return ['ui_cart_id' => $cart->ui_cart_id, 'items'=> []];

})->name('cart.show');

Route::post('/cart/{cart:ui_cart_id}/items/store', function (Cart $cart) {

    //$cart = Cart::byUICartId(request('ui_cart_id'))->first();


    $totalTaxes = collect(request('taxes'));

    $cart->addItem([
        'product_id' => request('product_id'),
        'title' => request('title'),
        'description' => request('description'),
        'slug' => request('slug'),
        'quantity' => request('quantity'),
        'price' => request('price'),
        'taxes' => request('taxes'),
        'total' => request('price') * request('quantity'),
        'total_with_taxes' => request('price') * request('quantity') * (1 + $totalTaxes->sum('value')),
    ]);

    return ['ui_cart_id' => $cart->ui_cart_id, 'items'=> $cart->items];


})->name('cart.items.store');






Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
