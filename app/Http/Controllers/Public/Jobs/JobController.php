<?php

namespace App\Http\Controllers\Public\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Company $company)
    {
        $jobs = $company->jobs()
            ->open()
            ->latest()
            ->get();

        return view('public.index', ['company' => $company, 'jobs' => $jobs]);
    }

    public function show(Company $company, Job $job)
    {
        return view('public.show', ['company' => $company, 'job' => $job]);
    }
}
