<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class InitializeCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {



        Log::info('current session id', [session()->id()]);



        if (!session()->has('cart')) {
            Log::info('in initialize cart');
            $cart = Cart::where('session_id', session()->id())->first();
            if ($cart) {
                session()->put('cart', $cart);
            } else {
                $cart = Cart::create([
                        'session_id' => session()->id(),
                    ]);
                session()->put('cart', $cart);
            }
        }


        return $next($request);
    }
}
