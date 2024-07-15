<?php

namespace App\Listeners;

use App\Events\MemberNotificationEvent;
use App\Models\MemberNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MemberNotificationListener
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
    public function handle(MemberNotificationEvent $event): void
    {
        MemberNotification::create($event->memberNotification);
    }
}
