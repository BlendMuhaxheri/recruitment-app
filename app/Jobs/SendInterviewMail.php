<?php

namespace App\Jobs;

use App\Mail\InterviewScheduledMail;
use App\Models\ActivityLog;
use App\Models\Interview;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendInterviewMail implements ShouldQueue
{
    use Queueable;

    public Interview $interview;

    /**
     * Create a new job instance.
     */
    public function __construct(Interview $interview)
    {
        $this->interview = $interview;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->interview->load(['application.candidate']);

        Mail::to($this->interview->application->candidate->email)
            ->send(new InterviewScheduledMail($this->interview));

        ActivityLog::create([
            'company_id'   => $this->interview->company_id,
            'candidate_id' => $this->interview->application->candidate->id,
            'action'       => "Interview scheduled mail sent!",
        ]);
    }
}
