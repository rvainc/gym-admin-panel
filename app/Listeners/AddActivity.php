<?php

namespace App\Listeners;

use App\Events\ActivityAdded;

class AddActivity
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
     * @param  \App\Events\ActivityAdded  $event
     * @return void
     */
    public function handle(ActivityAdded $event)
    {
        dump($event->variable);
    }
}
