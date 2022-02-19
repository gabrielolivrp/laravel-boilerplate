<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Events\Dispatcher;

class AuthEventHandler
{
    /**
     * @param $event
     * @return void
     */
    public function onLogin($event)
    {
        // Update the logging in users time and IP
        $event->user->update([
            'last_login_at' => now(),
            'last_login_ip' => request()->getClientIp(),
        ]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param Dispatcher $events
     * @return void
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Login::class,
            'App\Listeners\AuthEventHandler@onLogin'
        );
    }
}
