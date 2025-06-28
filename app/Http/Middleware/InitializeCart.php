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

        // if there's not cart in session
        // check there's a cart in the database with session_id = session()->id()
        // if there is a cart in the database with session_id = session()->id()
        // set the cart in the session to the cart in the database
        // else
        // create a new cart in the database with session_id = session()->id()
        // set the cart in the session to the cart in the database
        // else
        // create a new cart in the database with session_id = session()->id()
        // set the cart in the session to the cart in the database

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
        }/* else if(session()->has('cart')) {
            $cart = Cart::where('id', session('cart')->id)->first();

            if($cart->session_id !== session()->getId()) {
                $cart->session_id = session()->getId();
                $cart->save();
                session()->put('cart', $cart);
            }

        } */



        /* elseif (session()->has('cart')) {
            Log::info('in initialize cart, but external request,like login happened');

            if (session()->get('cart')->session_id !== session()->getId()) {
                //get cart in database with old session id
                $cart = Cart::where('session_id', session('cart')->session_id)->first();
                if ($cart) {
                    $cart->session_id = session()->getId();
                    $cart->save();
                    session()->put('cart', $cart);
                }
            }
        } */



        return $next($request);
    }
}
