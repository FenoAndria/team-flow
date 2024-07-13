<?php

namespace App\Listeners;

use App\Events\TeamNotificationEvent;
use App\Models\TeamNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TeamNotificationListener
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
    public function handle(TeamNotificationEvent $event): void
    {
        TeamNotification::create($event->teamNotification);
    }
}
