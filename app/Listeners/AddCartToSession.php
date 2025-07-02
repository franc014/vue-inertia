<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Log;

class AddCartToSession
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
        Log::info('cart in session?', [session('cart')]);
        $cart = session('cart');

        if ($cart) {
            $cart->user_id = $event->user->id;
            $cart->save();
        }
    }
}
