<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class RemoveUserFromCartOnLogout
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
    public function handle(Logout $event): void
    {
        Log::info('session id on logout', [session()->id()]);

        Log::info('in remove user from cart in logout', $event->user->toArray());
        $cart = session('cart');

        if ($cart) {
            $cart->user_id = null;
            $cart->session_id = session()->id();
            $cart->save();
            session()->put('cart', $cart->fresh());
        }

    }
}
