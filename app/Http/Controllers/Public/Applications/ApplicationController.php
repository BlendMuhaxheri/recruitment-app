<?php

namespace App\Http\Controllers\Public\Applications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Applications\StoreApplicationRequest;
use App\Models\Company;
use App\Models\Job;
use App\Services\Public\Applications\SubmitApplication;

class ApplicationController extends Controller
{
    protected SubmitApplication $service;

    public function __construct(SubmitApplication $service)
    {
        $this->service = $service;
    }

    public function create(Company $company, Job $job)
    {
        return view(
            'public.create',
            [
                'company' => $company,
                'job' => $job
            ]
        );
    }

    public function store(StoreApplicationRequest $request, Company $company, Job $job)
    {
        $validated = $request->validated();
        $this->service->submit($company, $job, $validated);

        return redirect()
            ->route('public.jobs.show', [$company->slug, $job->slug])
            ->with('success', 'Application submitted successfully!');
    }
}
