<?php


namespace App\Services\Companies;

use App\Events\InterviewScheduled;
use App\Models\Application;
use App\Models\Interview;

class SubmitInterview
{
    public function submit(array $validated, Application $application, int $companyId): Interview
    {
        $this->abortIfExists($application);
        $interview = $this->create($validated, $application, $companyId);
        $this->notifyUser($interview);

        return $interview;
    }

    private function abortIfExists(Application $application): void
    {
        abort_if($application->hasInterview(), 409, 'Interview already exists for this application.');
    }

    private function create(array $validated, Application $application, int $companyId): Interview
    {
        return $interview = Interview::create([
            ...$validated,
            'company_id'     => $companyId,
            'application_id' => $application->id,
        ]);
    }

    private function notifyUser(Interview $interview): void
    {
        event(new InterviewScheduled($interview));
    }
}
