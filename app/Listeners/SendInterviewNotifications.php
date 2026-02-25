<?php

namespace App\Listeners;

use App\Events\InterviewScheduled;
use App\Jobs\SendInterviewMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendInterviewNotifications
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
    public function handle(InterviewScheduled $event): void
    {
        SendInterviewMail::dispatch($event->interview);
    }
}
