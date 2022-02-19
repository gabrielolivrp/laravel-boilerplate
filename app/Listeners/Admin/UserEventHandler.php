<?php

namespace App\Listeners\Admin;

use App\Events\Admin\User\UserCreated;
use App\Events\Admin\User\UserUpdated;
use App\Events\Admin\User\UserDeleted;
use App\Events\Admin\User\UserRestored;
use App\Events\Admin\User\UserDestroyed;
use App\Events\Admin\User\UserConfirmed;
use App\Events\Admin\User\UserDeactivated;
use App\Events\Admin\User\UserReactivated;
use App\Events\Admin\User\UserUnconfirmed;
use Illuminate\Events\Dispatcher;

class UserEventHandler
{
    /**
     * @param $event
     * @return void
     */
    public function onCreated($event)
    {
        // ..
    }

    /**
     * @param $event
     * @return void
     */
    public function onUpdated($event)
    {
        // ..
    }

    /**
     * @param $event
     * @return void
     */
    public function onDestroyed($event)
    {
        // ..
    }

    /**
     * @param $event
     * @return void
     */
    public function onRestored($event)
    {
        // ..
    }

    /**
     * @param $event
     * @return void
     */
    public function onDeleted($event)
    {
        // ..
    }

    /**
     * @param $event
     * @return void
     */
    public function onDeactivated($event)
    {
        // ..
    }

    /**
     * @param $event
     * @return void
     */
    public function onReactivated($event)
    {
        // ..
    }

    /**
     * @param $event
     * @return void
     */
    public function onConfirmed($event)
    {
        // ..
    }

    /**
     * @param $event
     * @return void
     */
    public function onUnconfirmed($event)
    {
        // ..
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param Dispatcher $events
     * @return void
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(UserCreated::class,
            'App\Listeners\Admin\UserEventHandler@onCreated'
        );

        $events->listen(UserUpdated::class,
            'App\Listeners\Admin\UserEventHandler@onUpdated'
        );

        $events->listen(UserDestroyed::class,
            'App\Listeners\Admin\UserEventHandler@onDestroyed'
        );

        $events->listen(UserRestored::class,
            'App\Listeners\Admin\UserEventHandler@onRestored'
        );

        $events->listen(UserDeleted::class,
            'App\Listeners\Admin\UserEventHandler@onDeleted'
        );

        $events->listen(UserDeactivated::class,
            'App\Listeners\Admin\UserEventHandler@onDeactivated'
        );

        $events->listen(UserReactivated::class,
            'App\Listeners\Admin\UserEventHandler@onReactivated'
        );

        $events->listen(UserConfirmed::class,
            'App\Listeners\Admin\UserEventHandler@onConfirmed'
        );

        $events->listen(UserUnconfirmed::class,
            'App\Listeners\Admin\UserEventHandler@onUnconfirmed'
        );
    }
}
