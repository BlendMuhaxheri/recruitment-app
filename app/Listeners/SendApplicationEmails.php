<?php

namespace App\Listeners;

use App\Events\ApplicationSubmitted;
use App\Jobs\SendCandidateConfirmationEmail;
use App\Jobs\SendRecruiterNotificationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendApplicationEmails
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
    public function handle(ApplicationSubmitted $event): void
    {
        SendCandidateConfirmationEmail::dispatch($event->application);

        SendRecruiterNotificationEmail::dispatch($event->application);
    }
}
