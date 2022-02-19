<?php

namespace App\Listeners\Admin;

use App\Events\Admin\Role\RoleCreated;
use App\Events\Admin\Role\RoleUpdated;
use App\Events\Admin\Role\RoleDestroyed;

class RoleEventHandler
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
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(RoleCreated::class,
            'App\Listeners\Admin\RoleEventHandler@onCreated'
        );

        $events->listen(RoleUpdated::class,
            'App\Listeners\Admin\RoleEventHandler@onUpdated'
        );

        $events->listen(RoleDestroyed::class,
            'App\Listeners\Admin\RoleEventHandler@onDestroyed'
        );
    }
}
