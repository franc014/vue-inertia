<?php

namespace App\Listeners;

use App\Events\SessionHasChangedAfterLogout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class AssignNewSessionToCartAfterLogout
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
    public function handle(SessionHasChangedAfterLogout $event): void
    {
        $cart = $event->cartInDb;
        $sessionId = session()->getId();
        Log::info('in listener after logout...');

        Log::info('cart in db', $cart->toArray());

        Log::info('session id', [$sessionId]);

        $cart->session_id = session()->getId();

        $cart->save();
        session()->put('cart', $cart->fresh());
    }
}
