<?php

namespace App\Services\Public\Applications;

use App\Enums\Application\ApplicationStage;
use App\Events\ApplicationSubmitted;
use App\Exceptions\AlreadyAppliedException;
use App\Models\Application;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Support\Facades\DB;

class SubmitApplication
{
    public function submit(Company $company, Job $job, array $data): void
    {
        DB::transaction(function () use ($company, $job, $data) {
            $resumePath = $this->upload($data);
            $candidate  = $this->createCandidate($company, $data);
            $this->ensureNotAlreadyApplied($candidate, $job);
            $application = $this->createApplication($candidate, $data, $resumePath, $job);
            $this->dispatchApplicationSubmittedEvent($application);
        });
    }

    private function upload(array $data): ?string
    {
        $resumePath = null;

        if (isset($data['resume'])) {
            $resumePath = $data['resume']->store('resumes', 'public');
        }

        return $resumePath;
    }

    private function createCandidate($company, array $data): Candidate
    {
        return Candidate::firstOrCreate(
            [
                'company_id' => $company->id,
                'email'      => $data['email'],
            ],
            [
                'first_name' => $data['first_name'],
                'last_name'  => $data['last_name'],
                'phone'      => $data['phone'] ?? null,
            ]
        );
    }

    private function ensureNotAlreadyApplied(Candidate $candidate, Job $job): void
    {
        if ($candidate->hasAppliedTo($job)) {
            throw new AlreadyAppliedException();
        }
    }

    private function createApplication(
        Candidate $candidate,
        array $data,
        ?string $resumePath,
        Job $job
    ): Application {
        return $candidate->applications()->create([
            'candidate_id'      => $candidate->id,
            'resume_path'       => $resumePath,
            'cover_letter'      => $data['cover_letter'] ?? null,
            'job_id'            => $job->id,
            'application_stage' => ApplicationStage::Applied

        ]);
    }

    private function dispatchApplicationSubmittedEvent($application): void
    {
        event(new ApplicationSubmitted($application));
    }
}
