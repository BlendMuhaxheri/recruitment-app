<?php

namespace App\Http\Controllers\Company;

use App\Enums\Job as JobEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Job\StoreJobRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job as JobsJob;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('company_id', auth()->user()->company_id)
            ->latest()
            ->get();

        return view('company.jobs.index', ['jobs' => $jobs]);
    }

    public function create()
    {
        $types = [
            JobEnum::FULLTIME->value => 'Full Time',
            JobEnum::PARTTIME->value => 'Part Time',
        ];

        $statuses = [
            JobEnum::DRAFT->value  => 'Draft',
            JobEnum::OPEN->value   => 'Open',
            JobEnum::CLOSED->value => 'Closed',
        ];

        return view(
            'company.jobs.create',
            [
                'types' => JobEnum::typeOptions(),
                'statuses' => $statuses
            ]
        );
    }

    public function store(StoreJobRequest $request)
    {
        Job::create([
            ...$request->validatedAttributes(),
            'company_id' => auth()->user()->company_id
        ]);

        return redirect()->route('company.jobs.index');
    }
}
