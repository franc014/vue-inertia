<?php

namespace App\Listeners;

use App\Events\SessionHasChangedAfterLogout;
use App\Models\Cart;
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
        $cartInDb = Cart::where('session_id', session()->id())->first();

        Log::info('in remove user from cart in logout', $event->user->toArray());
        $cart = session('cart');

        Log::info('cart is alive?', $cart->toArray());

        //emit event with cart in db
        Log::info('emitting event with cart in db...', $cartInDb->toArray());

        SessionHasChangedAfterLogout::dispatch($cartInDb);


        if ($cart) {
            $cart->user_id = null;
            $cart->session_id = session()->id();
            $cart->save();
            session()->put('cart', $cart->fresh());
        }

    }
}
