<?php

namespace App\Jobs;

use App\Mail\CandidateApplicationReceivedMail;
use App\Models\ActivityLog;
use App\Models\Application;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendCandidateConfirmationEmail implements ShouldQueue
{
    use Queueable;

    public Application $application;
    /**
     * Create a new job instance.
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->application->load(['candidate', 'job']);

        Mail::to($this->application->candidate->email)
            ->send(new CandidateApplicationReceivedMail($this->application));

        ActivityLog::create([
            'company_id'   => $this->application->job->company_id,
            'candidate_id' => $this->application->candidate_id,
            'action'       => "Application confirmation email sent",
        ]);
    }
}
