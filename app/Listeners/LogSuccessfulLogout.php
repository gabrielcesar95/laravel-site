<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->user) {
            activity('Auth')
                ->performedOn($event->user)
                ->withProperties(
                    [
                        'ip' => request()->ip(),
                        'user_agent' => request()->userAgent()
                    ]
                )
                ->log('logout');
        }
    }
}
