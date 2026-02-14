<?php

namespace App\Http\Controllers\Company;

use App\Enums\Job\JobStatus;
use App\Enums\Job\JobType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Job\StoreJobRequest;
use App\Http\Requests\Job\UpdateJobRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = Job::where('company_id', $request->user()->company_id)
            ->latest()
            ->get();

        return view('company.jobs.index', [
            'jobs' => $jobs,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Job::class);

        return view('company.jobs.create', [
            'types'    => JobType::options(),
            'statuses' => JobStatus::options(),
        ]);
    }

    public function store(StoreJobRequest $request)
    {
        $this->authorize('create', Job::class);

        Job::create([
            ...$request->validatedAttributes(),
            'company_id' => $request->user()->company_id,
        ]);

        return redirect()->route('company.jobs.index');
    }

    public function show(Job $job)
    {
        $this->authorize('view', $job);

        return view('company.jobs.show', [
            'job' => $job,
        ]);
    }

    public function edit(Job $job)
    {
        $this->authorize('update', $job);

        return view('company.jobs.edit', [
            'job'      => $job,
            'types'    => JobType::options(),
            'statuses' => JobStatus::options(),
        ]);
    }

    public function update(UpdateJobRequest $request, Job $job)
    {
        $this->authorize('update', $job);

        $job->update($request->validatedAttributes());

        return redirect()->route('company.jobs.index');
    }

    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);

        $job->delete(); // Soft delete

        return redirect()->route('company.jobs.index');
    }
}
