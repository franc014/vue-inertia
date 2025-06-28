<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Authenticated;

class AssignUserToCartOnLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Authenticated $event): void
    {



        Log::info('session id on login', [session()->id()]);

        Log::info('in assign user to cart', $event->user->toArray());
        $cart = session('cart');

        //get current session id
        //$si = session()->getId();


        if ($cart) {
            $cart->user_id = $event->user->id;
            $cart->session_id = session()->id();
            $cart->save();
            session()->put('cart', $cart->fresh());
        }
    }
}
